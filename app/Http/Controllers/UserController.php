<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PasswordRequest;
use App\Models\ContactMessage;
use App\Models\PaymentAmount;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use stdClass;

class UserController extends Controller
{

    public function index(Request $request)
    {

            $unread_notis = User::find(1)->unreadNotifications;
            $read_notis = User::find(1)->notifications;
            $new_purchases = $unread_notis->where('type', 'App\Notifications\CoinPurchase')->all();
            $new_subscriptions = $unread_notis->where('type', 'App\Notifications\VipPurchase')->all();

            $data = (object)[
                'purchases' => $new_purchases,
                'subscriptions' => $new_subscriptions,
            ];

            return view('admin.dashboard', compact('data'));

    }

    public function myAccount(Request $request)
    {
        $user= $request->user();
        $user_type = $user->user_type_id;

        //redireccion administradaor
        if($user_type===5){
            return $this->index($request);
        }

        $coins= $user->coins;
        $profile = $user->Profile();

        $is_agency = $user_type===2;

        $agency_cost= $user_type==1 ? escortCost():agencyCost();

        return view('user.account', compact('profile','coins','is_agency','agency_cost'));

    }

    public function myProfile(Request $request)
    {
        $user=$request->user();
        $profile = $user->Profile();


        if($user->user_type_id == 1 ){
            return  view('user.escort.profile', compact('profile'));
        }

        return view('user.agency.profile', compact('profile'));
    }



    public function changePass(Request $request)
    {

        return view('user.changepassword');
    }




    public function becomeVip(Request $request)
    {
        $user= $request->user();
        $user_type = $user->user_type_id;
        $user_coins= $user->coins;

        $vip_cost= escortCost();

        $profile =  $user->Profile();
        $has_enough_coins=$user->coins >= $vip_cost;
        $show_vip_button= false;
        $already_vip=null;
        if($profile){

            $escorts = $profile->type_id == 2 ? $profile->Escorts()->where('approved',1)->where('is_vip',0)->get() : false;

            $is_approved = $profile->approved == 1 ? true : false;
            $show_vip_button=  $user_type==1 && $is_approved && !$profile->is_vip && $has_enough_coins;
            $already_vip=  $profile->is_vip == 1 ?true:false;

        }else{

            $escorts=false;
            $is_approved =false;

        }

        $messages=null;
        if($user_type==1){
            $no_approved_message=Lang::get('general.profile_approved');
            $no_profile_message=Lang::get('general.no_profile');
            $no_coins_message= Lang::get('general.Not_enough_coins');
            $messages= new stdClass();
            $messages->no_profile=$no_profile_message;
            $messages->not_approved=$no_approved_message;
            $messages->no_coins=$no_coins_message;
        }


        return view('user.become-vip',compact( 'vip_cost', 'escorts','user_type','show_vip_button','messages','already_vip'));
    }

    public function activateVip(Request $request){
       return app('App\Http\Controllers\VipSubscriptionController')->store($request);
    }

    public function buyCoins(Request $request)
    {

        $pay_amounts = PaymentAmount::all();
        $user= $request->user();
        $profile =  $user->Profile();


        return view('user.buy-coins', compact('pay_amounts','profile'));

    }

    public function showPayments(Request $request)
    {

        $user = $request->user();

        $profile= $user->Profile();
        if(!$profile){
            return redirect()->route('my-account')->with('error',Lang::get('general.no_profile'));
        }
        // $purchases = $request->user()->purchases; // Muestra todas las Facturas pagadas y no pagadas

         $purchases = $request->user()->Purchases()->where('status','!=','unpaid')->get(); // No muestra las facturas no pagadas

        return view('user.payments', compact('purchases'));
    }


    public function showExpenses(Request $request)
    {


        $expenses = $request->user()->Expenses;

        return view('user.expenses', compact('purchases'));
    }


    public function myMessages(Request $request)
    {


        $user = $request->user();

        $profile= $user->Profile();
        if(!$profile){
          return redirect()->route('my-account')->with('error',Lang::get('general.no_profile'));
        }
        $messages=[];

        foreach ($profile->Messages as $message ) {
            array_push($messages,$message);
        }



        $profiles= $profile->Escorts;
        if($profiles){
            foreach($profiles as $key=> $escort){
                if($escort->id !==$profile->id){
                    foreach ($escort->Messages as $message ) {
                        array_push($messages,$message);
                    }
                }

            }
        }


        return view('user.messages', compact('messages'));
    }

    public function deleteMessage(Request $request)
    {

        if ($request->ajax()) {

            $user = $request->user();
            $msg_id = $request->msg_id;
            $message=ContactMessage::where('id', $msg_id)->first();
            $profile_user_id= $message->Profile->user_id;

            if($user->id==$profile_user_id){
                try {
                    ContactMessage::where('id', $msg_id)->first()->delete();
                } catch (\Throwable $th) {
                    return response()->json('some error', 202);
                }
            }



            return response()->json('deleted', 200);
        }
        abort(403);
    }


    // Usuario cambia su contraseña
        /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {


        $request->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
