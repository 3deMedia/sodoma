<?php

namespace App\Http\Controllers;

use App\Models\PaymentAmount;
use App\Models\Purchase;
use App\Models\User;
use App\Notifications\CoinPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use PDF;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Stripe\StripeClient;


class PaymentsController extends Controller
{

    private $client;
    private $stripe_client;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->stripe_client = new StripeClient(env('STRIPE_SECRET'));
        $environment = new ProductionEnvironment($payPalConfig['client_id'], $payPalConfig['client_secret']);
        $this->client = new PayPalHttpClient($environment);
    }


    // muestra el pdf del pago al usuario
    public function showPdf(Purchase $purchase, Request $request)
    {
        if ($purchase) {
            $user= $request->user();

            $profile =  $user->Profile();

            $content =  PDF::loadView('pdf.purchase', compact('purchase','profile'));

            return  $content->stream('compra.pdf');
        } else {
            return view('errors.404');
        }
    }



    // creamos una session de checkout, luego habrá que capturarla
    public function paypalCheckout(Request $request)
    {

        $product = PaymentAmount::find($request->product);
        if(!$product){
            return back();
        }

        $paypal_request = new OrdersCreateRequest();
        $paypal_request->prefer('return=representation');
        $paypal_request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                // "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => $product->euros,
                    "currency_code" => "EUR"
                ]
            ]]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($paypal_request);

            // guardar el $response->result

            Purchase::create([
                'user_id' => $request->user()->id,
                'order_id' => $response->result->id,
                'intent' => $response->result->intent,
                'payment_method' => 'paypal',
                'amount' => $product->euros,
                'status' => 'unpaid'
            ]);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return response()->json($response->result);
        } catch (HttpException $ex) {

            return response()->json($ex->getMessage());
        }



        return;
    }

    // Capturamos la transaccion para conocer el resultado y almacenarlo
    public function paypalCaptureTransaction(Request $request)
    {
        $order_id = $request->order['orderID'];
        if ($order_id) {
            $order_request = new OrdersCaptureRequest($order_id);
            $order_request->prefer('return=representation');
            try {
                // Call API with your client and get a response for your call
                $response = $this->client->execute($order_request);
                if ($response->result->status == "COMPLETED") {
                    $order_id = $response->result->id;
                    $purchase = Purchase::where('order_id', $order_id)->first();
                    if ($purchase->status == 'success') {
                        return redirect()->route('dashboard');
                    } else {
                        $payment_data= PaymentAmount::where('euros',intval($purchase->amount))->first();
                        $total_coins = $request->user()->coins + $payment_data->coins;

                        $request->user()->update([
                            'coins' => $total_coins
                        ]);
                        $admin = User::find(1);
                        $purchase_noti = (object)[
                            'user_id' => $purchase->user_id,
                            'via' => 'paypal',
                            'amount' => $payment_data->euros,
                            'coins' => $payment_data->coins
                        ];
                        $admin->notify(new CoinPurchase($purchase_noti));

                        $purchase->update(['status' => "success"]);
                    }
                }


                // If call returns body in response, you can get the deserialized version from the result attribute of the response
                return response()->json($response);
            } catch (HttpException $ex) {

                return response()->json($ex->getMessage(), 400);
            }
        }
    }

    /***ZONA STRIPE */
    /**
     * Prepara el pago para enviar al checkout de stripe
     *
     * @param Request $request
     * @return void
     */
    public function stripeCheckout(Request $request)
    {


        $product_id = intval($request->product);
        $product = PaymentAmount::find($product_id);

        if (!$product) {
            return back()->with('error', 'Something went wrong...');
        }


        $stripe_session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[

                'price' => $product->stripe_price_id,
                'quantity' => 1,
              ]],
            'mode' => 'payment',
            'payment_intent_data' => [],
            'success_url' => route('success-stripe-payment') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' =>  route('failure-stripe-payment'),
        ]);
        $this->stripe_client = $stripe_session;
        Purchase::create([
            'user_id' => $request->user()->id,
            'order_id' => $stripe_session->id,
            'intent' => 'intent', // antes podia acceder a $stripe_session->payment_intent,ahora solo devuelve null. No sirve.
            'payment_method' => 'stripe',
            'amount' => $product->euros, //euros
            'status' => $stripe_session->payment_status,
        ]);

        return redirect($stripe_session->url);
    }

    /**
     * Procesa pago stripe realizado con éxito
     *
     * @param Request $request
     * @return void
     */
    public function processSuccessPayment(Request $request)
    {
        $session_id = $request->get('session_id');
        $session = $this->stripe_client->checkout->sessions->retrieve($session_id);

        $purchase = Purchase::where('order_id', $session_id)->first();

        if ($purchase->status == 'success') {
            return redirect()->route('my-profile');
        } else {
            if ($session->payment_status == 'paid') {
                $purchase->update([
                    'status' => 'success',
                    'email' => $session->customer_details->email
                ]);
               $payment_data= PaymentAmount::where('euros',intval($purchase->amount))->first();

                $total_coins = $request->user()->coins + $payment_data->coins;

                $request->user()->update([
                    'coins' => $total_coins
                ]);


                $admin = User::find(1);
                $purcha = (object)[
                    'user_id' => $purchase->user_id,
                    'via' => $purchase->payment_method,
                    'amount' => $purchase->amount,
                    'coins' => $purchase->amount * 2
                ];
                $admin->notify(new CoinPurchase($purcha));
            }

            // FERNANDO!! AQUI PUEDES PASAR DATOS "compact('variable')"
            //Y REDIRIGIR A UNA NUEVA VISTA BLADE BONITA  O HAZ COMO VEAS

            return redirect()->route('my-account')->with('paysuccess','Pago realizado correctamente');
        }
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function processFailurePayment(Request $request)
    {


        return redirect()->route('my-account')->with('error', Lang::get('general.vip.some_error'));
    }
}
