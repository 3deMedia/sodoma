<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Feature;
use App\Models\Ownership;
use App\Models\Photo;
use App\Models\PhotoReview;
use App\Models\Profile;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;


class AgencyController extends Controller
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

    }


    public function myEscorts(Request $request)
    {
        $user= $request->user();
        $profile = $user->Profile();
        if(!$profile){
            return redirect()->route('my-account')->with('error','Debes tener el perfil aprovado y activo');
        }
        $escorts = $profile->Escorts()->get();

        $is_approved = $profile->approved == 1 ? true : false;
        $new_escort_cost= escortCost();
        $has_enough_coins = $user->coins >= $new_escort_cost ? true : false;

        $can_purchase = $is_approved && $has_enough_coins;


        return view('user.agency.agency-escorts-tabpanel', compact('escorts','can_purchase','profile'));
    }

    /**
     * Activa la cuenta de las agencias para ser visibles. Ser agencia tiene un coste fijo mensual.
     *
     * @param Request $request
     * @return void
     */
    public function activateAccount(Request $request)
    {
        $user= $request->user();
        $user_coins= $user->coins;
        $cost= escortCost();
        $profile=$user->Profile();
        if($profile){
            if(!$profile->approved){
                return redirect()->route('my-account')->with('error','Para activar tu cuenta debes esperar a que tu perfil se haya aprovado');
            }

            $has_period= $user->Profile()->monthly_agency_period;
            if($user_coins >= $cost && !$has_period){
                $now= Carbon::today()->addMonth(1);
                $updated_coins= $user_coins-$cost;
                $user->Profile()->update(['monthly_agency_period'=>$now]);
                $user->update(['coins'=>$updated_coins]);
                $escorts= $profile->Escorts()->get();
                if($escorts){
                    foreach ($escorts as  $scrt) {
                        $scrt->update(['active'=>1]);
                    }
                }
                return redirect()->route('my-account')->with('success','Cuenta activada correctamente');
            }else{
                return redirect()->route('my-account')->with('error','No tienes coins o ya tienes la cuenta activada');

            }
        }else{
            return redirect()->route('my-account')->with('error','No tienes ningun perfil creado');

        }
    }



    /**
     * Guarda la escort de la agencia.
     *
     *
     * @return void
     */
    public function storeEscort(Request $request)
    {
        $validator = $this->validateEscortForm($request);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = $request->user();
        $profile= $user->Profile();

        $request['user_id'] = $user->id;
        $request['type_id'] = 1;
        $request['email']=$profile->email;
        $request['phone']=$profile->phone;
        $hide_face= $request->hide_face ? 1:0;
        $request['hide_face']= $hide_face;

        $request['uid']= $this->createProfileUid($request->name);

        $escort = Profile::create($request->all());
        $escort->update(['active'=>1]);
        $request['profile_id']=$escort->id;

        $this->storePhotos($request,$escort);
        $request['nationality_id'] = $request->nationality_id =='null' ? null:$request->nationality_id;
        Feature::create($request->all());
        Rate::create($request->all());
        $request['address']=$request->profile_address;
        Address::create($request->all());

        // para buscar las escorts asociados a una agencia generamos un ownership
        Ownership::create([
            'owner_id'=>$profile->id,
            'owned_id'=>$escort->id
        ]);

        // Actuliza coins
        $new_escort_cost= escortCost();
        $new_coins_amount = $request->user()->coins - $new_escort_cost ;
        $user->update(['coins' => $new_coins_amount]);

        return back()->with('success', Lang::get('general.create_escort_success'));
    }

    public function updateEscort(Request $request, Profile $profile){
        $user = $request->user();
        if ($profile->user_id !== $user->id) {
            // banear usuario
            $this->banUser($request, $user);
            return back()->with('error', 'error');
        }

        $request['profile_id'] = $profile->id;

        $validator = $this->validateEscortForm($request);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $hide_face= $request->hide_face ? 1:0;
        $request['hide_face']= $hide_face;
        $profile->update($request->all());

        // update images
        $images = $request->file('photos');

        if ($images) {
            $this->updatePhotos($request, $profile);
        }

        // changed mainPhoto,Features and Address only affects to escorts

        $main_photo_id = $profile->MainPhoto()->id;

        if($main_photo_id !== intval($request->main_photo)){

            $this->updateMainPhoto($request,$profile);

        }

         // update features
        $profile->Features->update($request->all());

        // update Rates
        $profile->Rates->update($request->all());

        // update Address
        $request['address']=$request->profile_address;
        $profile->Address->update($request->all());

        return redirect()->route('my-escorts')->with('success', Lang::get('general.update_success'));
    }

    /**
     * Dirige a la pagina para editar la escort
     *
     * @param Request $request
     * @param Escort $escort
     * @return View // la vista
     */
    public function editEscort(Request $request,Profile $profile)
    {

        if ($request->user()->id !== $profile->user_id || $profile->type_id != 1 ) {
            abort(403);
        }

        $agency=$request->user()->Profile();
        return view('user.agency.update-escort-form', compact('profile','agency'));
    }

    /**
     * Actualiza datos escort
     */


    public function destroyEscort(Request $request, Profile $profile)
    {


    }

    /**
     * Agencia invisibiliza escort
     *
     * @param Request $request
     * @param Escort $profile
     * @return void
     */
    public function disableEscort(Request $request, Profile $profile)
    {
        if ($request->ajax()) {

            $user_id = $request->user()->id;

            if ($profile->user_id== $user_id) {
                $profile->update(['active' => 0]);
                return response()->json("ok", 200);
            }

            return response()->json("wrong credentials", 403);
        }
    }


    /**
     * Agencia visibiliza escort
     *
     * @param Request $request
     * @param Escort $profile
     * @return void
     */
    public function enableEscort(Request $request, Profile $profile)
    {
        if ($request->ajax()) {

            $user_id = $request->user()->id;

            if ($profile->user_id== $user_id) {
                $profile->update(['active' => 1]);
                return response()->json("ok", 200);
            }
            return response()->json("wrong credentials", 403);
        }
    }




    /*** imAGENES DE ESCORT DE AGENCIA */


    public function storePhotos(Request $request,Profile $profile)
    {
        $year = now()->year;
        $month = now()->month;
        $images= $request->file('photos');
        $max_fotos = $profile->is_vip ? maxPhohos(true): maxPhohos();
        foreach ($images as $key => $img) {

            $info= getimagesize($img);
            $img_width= $info[0];
            $img_height= $info[1];
            $orientation = $img_height > $img_width ? 'portrait' :'landscape';

            if ($key < $max_fotos ) {

                $extension = $img->getClientOriginalExtension();
                $filename = time() . "$key." . $extension;

                if ($key == 0) {
                    Photo::create([
                        'profile_id' => $profile->id,
                        'filename' => "$filename",
                        'path' => "$year/$month",
                        'orientation'=>$orientation,
                        'is_main' => 1
                    ]);
                } else {
                    Photo::create([
                        'profile_id' => $profile->id,
                        'filename' => "$filename",
                        'path' => "$year/$month",
                        'orientation'=>$orientation
                    ]);
                }

                $img->storeAs("public/escort_photos/$year/$month", $filename);
            }
        }
    }

    /**
     * Actualiza Imagenes Escort
     *
     * @param Request $request
     * @param Profile $profile
     * @return void
     */
    public function updatePhotos(Request $request, Profile $profile)
    {

            $images =  $request->file('photos');
            $images_toupload_count = count($request->file('photos'));
            $max_images = $profile->is_vip ? maxPhohos(true): maxPhohos();
            $path = 'public/escort_photos';
            $current_images_count = $profile->Photos->count();




        if (($images_toupload_count + $current_images_count) <= $max_images) {
            $year = now()->year;
            $month = now()->month;
            foreach ($images as $key => $img) {

                $info= getimagesize($img);
                $img_width= $info[0];
                $img_height= $info[1];
                $orientation = $img_height > $img_width ? 'portrait' :'landscape';

                $extension = $img->getClientOriginalExtension();
                $filename = time() . "$key." . $extension;

                try {
                    if ($key == 0) {
                        $is_main = $current_images_count ? 0:1;
                       $photo= Photo::create([
                            'profile_id' => $request->profile_id,
                            'filename' => "$filename",
                            'path' => "$year/$month",
                            'is_main' => $is_main,
                            'orientation'=>$orientation
                        ]);
                    } else {
                        $photo= Photo::create([
                            'profile_id' => $request->profile_id,
                            'filename' => "$filename",
                            'path' => "$year/$month",
                            'orientation'=>$orientation
                        ]);
                    }
                    $img->storeAs("$path/$year/$month", $filename);
                    PhotoReview::create([
                        'profile_id' => $profile->id,
                        'photo_id' => $photo->id
                    ]);


                    $msg = true;
                } catch (\Throwable $th) {
                    $msg = false;
                    break;
                }
            }
            return $msg;
        }
    }






    public function updateMainPhoto(Request $request,Profile $profile){

        $photos= $profile->Photos();
        $photo_exists= $photos->where('id',$request->main_photo)->exists();

        if($photo_exists){

            $profile->MainPhoto()->update(['is_main'=>0]);
            $photos->where('id',$request->main_photo)->first()->update(['is_main'=>1]);

        }

        return ;

    }

      /**
     * Crear uid para url de perfil
     *
     * @param \string $name
     * @return \string
     */
    protected function createProfileUid($name){

        $clean_name= strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', str_replace(' ', '',$name)));
        do {
            $number= rand(1001,9999);
            $uid= "$clean_name-$number";
            $profile= Profile::where('uid',$uid)->exists();
        } while ($profile);

        return $uid;

    }


    public function validateEscortForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'profile_address' => 'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'country_id' => 'required',
            'travel_range_id' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'height' => 'required',
            'languages' => 'required',
            'smoker' => 'required',
            'private_apartament' => 'required',
            'creditcard_acceptance' => 'required',
            'whatsapp_acceptance' => 'required',
            'is_pornstar' => 'required',
            'nationality_id' => 'required',
            'services' => 'required',
            'one_hour' => 'required',
        ]);
        return $validator;
    }

}
