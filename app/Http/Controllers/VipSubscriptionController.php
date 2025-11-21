<?php

namespace App\Http\Controllers;

use App\Models\AgencyBanner;
use App\Models\Profile;
use App\Models\User;
use App\Models\VipSubscription;
use App\Notifications\VipPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class VipSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = $request->user();
        $profile = $user->Profile();


        $type = $profile->type_id;
        $cost = $type==1 ? escortCost():agencyCost();


        // comprobamos que tenga monedas

        $amount_left = $user->coins - $cost;

        if ($amount_left < 0) {
            return redirect()->back()->with('error', Lang::get('general.Not_enough_coins'));
        }

        // probamos de crear la transacción
        try {

            DB::beginTransaction();
            $ends_at = Carbon::now()->addMonth();
            $vip_su =  VipSubscription::create([
                'profile_id' => $profile->id,
                'ends_at' => $ends_at,
                'status' => 1
            ]);
            $profile->update(['is_vip' => 1]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->with('error', Lang::get('general.vip.some_error'));
        }

        // si funciona la transaccion  actualizamos monedas;

        $user->update(['coins' => $amount_left]);

        // generamos notis pal admin;

        $admin = User::find(1);

        $noti_vip = (object)[
            'profile_id' => $profile->id,
            'purchase_id' => $vip_su->id,
        ];

        $admin->notify(new VipPurchase($noti_vip));

        return redirect('my-account')->with('success', Lang::get('general.vip.greetings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VipSubscription  $vipSubscription
     * @return \Illuminate\Http\Response
     */
    public function show(VipSubscription $vipSubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VipSubscription  $vipSubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(VipSubscription $vipSubscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VipSubscription  $vipSubscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VipSubscription $vipSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VipSubscription  $vipSubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(VipSubscription $vipSubscription)
    {
        //
    }





    public function setProfileVip(Request $request)
    {
        if ($request->ajax()) {

            $demandant = $request->user();
            $profile= Profile::find(intval($request->profile));
            if(!$profile ||($profile->user_id != $demandant->id )){
                $resp_data = (object)['message' => Lang::get('general.vip.some_error'), 'status' => 400];
                return response()->json($resp_data);
            }

            $cost = $profile->type_id==1 ? escortCost():agencyCost();
            $amount_left = $demandant->coins - $cost;

            if ($amount_left < 0) {
                $resp_data = (object)['message' => Lang::get('general.Not_enough_coins'), 'status' => 400];
                return response()->json($resp_data);
            }

            try {
                DB::beginTransaction();
                $time = Carbon::now()->addMonth();

                $vip_su =  VipSubscription::create([
                    'profile_id' => $profile->id,
                    'ends_at' => $time,
                    'status' => 1
                ]);
                $profile->update(['is_vip' => 1]);


                $admin = User::find(1);
                $noti_vip = (object)[
                    'profile_id' => $profile->id,
                    'type' => 'escort',
                    'purchase_id' => $vip_su->id,
                    'purchase_type' => 'create'
                ];

                $admin->notify(new VipPurchase($noti_vip));

                $demandant->update(['coins' => $amount_left]);
                $resp_data =  ['message' => Lang::get('general.vip.greetings'), 'status' => 200];
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $resp_data = ['message' => Lang::get('general.vip.some_error'), 'status' => 400];
            }

            return response()->json($resp_data);
        }
    }
}
