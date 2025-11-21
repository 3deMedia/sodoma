<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BannedUser;
use App\Models\Feature;
use App\Models\Photo;
use App\Models\PhotoReview;
use App\Models\Profile;
use App\Models\Rate;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
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

        //creamos nuevo perfil
        if($user->user_type_id == 1 ){
            $validator = $this->validateEscortForm($request);
        }else{
            $validator = $this->validateAgencyForm($request);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $web=$request->web ?? null;
            $url_escort= $this->createProfileUid($request->name);
            $hide_face= $request->hide_face ? 1:0;
            $request['hide_face']= $hide_face;
            $profile = Profile::create([
                'user_id' => $user->id,
                'type_id' => $user->user_type_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => $request->description,
                'web'=> $web,
                'uid'=>$url_escort,
                'hide_face'=>$hide_face
            ]);


        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }

        $request['profile_id'] = $profile->id;

        $images_count = $user->user_type_id == 1 ? count($request->file('photos')) : 1;

        $max_images =  $profile->type_id == 1 ? maxPhohos():1;
        if($request->file('logo')){
            $this->storelogo($request);
        }
        if ($images_count > 0 && $images_count <= $max_images) {
            $success_images = $this->storePhotos($request,$profile->type_id);
        } else {
            $profile->delete();
            return back()->with('error', 'Se necesitan máximo de ' . $max_images . ' fotos');

        }

        if ($user->user_type_id == 1) {


            $this->storeFeatures($request);

            $this->storeRates($request);

        }

        $this->storeAddress($request);

        return redirect()->route('my-account')->with('success', Lang::get('general.update_success'));
    }
    public function storeLogo(Request $request){


        $profile= $request->user()->Profile();
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:5048'
        ]);
        $old_logo= Photo::where('profile_id',$profile->id)->where('type',1)->first();
        if($old_logo){
            $old_logo->delete();
            $deleted= Storage::delete('public/agency_photos/'.$old_logo->path."/".$old_logo->filename);
        }

        $image =  $request->file('logo');
        $path = 'public/agency_photos';
        $year = now()->year;
        $month = now()->month;
        $extension = $image->getClientOriginalExtension();
        $filename = time() .".". $extension;
        Photo::create([
            'profile_id' => $profile->id,
            'filename' => "$filename",
            'path' => "$year/$month",
            'orientation'=>'portrait',
            'is_main' => 0,
            'type'=>1
        ]);
        $image->storeAs("$path/$year/$month", $filename);


    }

    public function storePhotos(Request $request,$profile_type)
    {

        // si hay imagenes en el form
        $year = now()->year;
        $month = now()->month;
        $images = $profile_type == 1 ? $request->file('photos'): [$request->file('photo')];
        $path = $profile_type == 1 ? 'public/escort_photos':'public/agency_photos';

        foreach ($images as $key => $img) {

            $info= getimagesize($img);
            $img_width= $info[0];
            $img_height= $info[1];
            $orientation = $img_height > $img_width ? 'portrait' :'landscape';


            $extension = $img->getClientOriginalExtension();
            $filename = time() . "$key." . $extension;

            try {
                if ($key == 0) {
                    Photo::create([
                        'profile_id' => $request->profile_id,
                        'filename' => "$filename",
                        'path' => "$year/$month",
                        'is_main' => 1,
                        'orientation'=>$orientation
                    ]);
                } else {
                    Photo::create([
                        'profile_id' => $request->profile_id,
                        'filename' => "$filename",
                        'path' => "$year/$month",
                        'orientation'=>$orientation
                    ]);
                }
                $img->storeAs("$path/$year/$month", $filename);
                $msg = true;
            } catch (\Throwable $th) {
                $msg = false;
                break;
            }
        }
        return $msg;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */

    public function storeFeatures(Request $request)
    {



        try {
            $request['nationality_id'] = $request->nationality_id =='null' ? null:$request->nationality_id;
            Feature::create($request->all());
        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            return false;
        }

        return true;
    }


    public function storeRates(Request $request)
    {



        try {
            Rate::create($request->all());
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }


    public function storeAddress(Request $request)
    {


        try {
            $request['address']=$request->profile_address;
            Address::create($request->all());
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

        $user = $request->user();
        if ($profile->user_id !== $user->id) {
            // banear usuario
            $this->banUser($request, $user);
            return back()->with('error', 'error');
        }

        $request['profile_id'] = $profile->id;

        if($profile->type_id==1){
            $validator = $this->validateEscortForm($request);
        }else{
            $validator = $this->validateAgencyForm($request);
        }


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $hide_face= $request->hide_face? 1:0;
        $request['hide_face']= $hide_face;
        $profile->update($request->all());

        // update images
        $images = $profile->type_id == 1 ?  $request->has('photos'): $request->has('photo');
        if($request->file('logo')){
            $this->storelogo($request);
        }

        if ($images) {
            $this->updatePhotos($request, $profile);
        }

        // changed mainPhoto,Features and Address only affects to escorts
        if($profile->type_id==1){
            $main_photo_id = $profile->MainPhoto()->id;

            if($main_photo_id !== intval($request->main_photo)){

                $this->updateMainPhoto($request,$profile);

            }
                   // update features
            $profile->Features->update($request->all());
            // update Rates
            $profile->Rates->update($request->all());
        }



        // update Address
        $request['address']=$request->profile_address;
        $profile->Address->update($request->all());

        return redirect()->route('my-account')->with('success', Lang::get('general.update_success'));
    }

    /**
     * Actualizar foto principal del perfil
     *
     * @param Request $request
     * @param Profile $profile
     * @return void
     */
    public function updateMainPhoto(Request $request,Profile $profile){

        $photos= $profile->Photos();
        $photo_exists= $photos->where('id',$request->main_photo)->exists();

        if($photo_exists){


           $new_main= $photos->where('id',$request->main_photo)->first();
           if($new_main->approved){
            $profile->MainPhoto()->update(['is_main'=>0]);
               $new_main->update(['is_main'=>1]);
           }
        }

        return;

    }

    public function updatePhotos(Request $request, Profile $profile)
    {
        if($profile->type_id == 1 ){
            $images =  $request->file('photos');
            $images_toupload_count = count($request->file('photos'));
            $max_images = $profile->is_vip ? maxPhohos(true): maxPhohos();
            $path = 'public/escort_photos';
            $current_images_count = $profile->Photos->count();

        }else{
            $images = [$request->file('photo')];
            $images_toupload_count = 1;
            $max_images = 1;
            $path = 'public/agency_photos';
            $current_images_count = 0;
            $profile->update(['approved'=>0]);
            $photo=$profile->MainPhoto();
            $filepath = "$path/$photo->path/$photo->filename";
            Storage::delete($filepath);
            $photo->delete();

        }


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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Profile $profile)
    {

        // if ($request->user()->id !== $profile->user_id || $profile->type_id != 1 ) {
        //     abort(403);
        // }
        // $profile->delete();


        // return back();
    }

    /**
     * Borrar una sola imagen del profile
     *
     * @param Request $request
     * @param Photo $photo
     * @return void
     */
    public function deletePhoto(Request $request, Photo $photo)
    {
        $user = $request->user();
        // comprobamos que tenga una foto minimo
        $demandant_profile = $user->Profile();

        $photo_profile= $photo->Profile;

        if($photo_profile->user_id !== $demandant_profile->user_id){
          $this->banUser($request,$user);
          return back()->with('error', 'error');
        }

        $photos = $photo_profile->Photos();

        $photos_count = $photos->count();

        // si solo hay una imagen o es la principal no se puede borrar
        if ($photos_count <= 1 or $photo->is_main) {

            return back()->with('error','No puedes borrar la foto principal');

        }else{

            $path = $photo_profile->type_id === 1 ? 'public/escort_photos' : 'public/agency_photos';
            $filepath = "$path/$photo->path/$photo->filename";
            Storage::delete($filepath);
            $photo->delete();
            return back()->with('success','Eliminado correctamente');
        }


    }

    /**
     * Borrar todas las fotos de un profile
     *
     * @param Profile $profile
     * @return void
     */
    public function destroyPhotos(Profile $profile)
    {
        $photos = $profile->Photos;
        $path = $profile->type_id === 1 ? 'public/escort_photos' : 'public/agency_photos';
        foreach ($photos as $photo) {

            $filepath = "$path/$photo->path/$photo->filename";
            Storage::delete($filepath);

            if ($photo->Review) {
                $photo->Review->delete();
            }

            $photo->delete();
        }
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

    /**
     * Banear al usuario por mmanipular los id en los forms o algo que no debe
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    protected function banUser(Request $request, User $user)
    {

        BannedUser::create([
            'email' => $user->email,
            'ip' => $request->ip()
        ]);

        $profiles = Profile::where('user_id', $user->id)->get();
        //borrar images
        foreach ($profiles as $profile) {
            $this->destroyPhotos($profile);
        }

        $user->delete();

        return;
    }

    public function validateEscortForm(Request $request)
    {
        //si hay proifle_id es un update(unique email con profile).
        if ($request->profile_id) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'description' => 'required|string',
                'photos.*' => 'image|mimes:jpeg,png,jpg,svg|max:5048',
                'city_id' => 'required|integer',
                'region_id' => 'required|integer',
                'profile_address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'country_id' => 'required|integer',
                'gender' => 'required',
                'age' => 'required|integer',
                'height' => 'required|integer',
                'languages' => 'required',
                'smoker' => 'required|integer',
                'private_apartament' => 'required|integer',
                'creditcard_acceptance' => 'required|integer',
                'whatsapp_acceptance' => 'required|integer',
                'is_pornstar' => 'required|integer',
                'nationality_id' => 'required|integer',
                'services' => 'required',
                'one_hour' => 'required|integer|max:9999'
            ]);

        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'description' => 'required|string',
                'photos.*' => 'image|mimes:jpeg,png,jpg,svg|max:5048',
                'city_id' => 'required',
                'region_id' => 'required',
                'country_id' => 'required',
                'profile_address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
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
                'one_hour' => 'required'
            ]);
        }




        return $validator;
    }

    public function validateAgencyForm(Request $request)
    {
        //si hay proifle_id es un update(unique email con profile).
        if ($request->profile_id) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'description' => 'required|string',
                'photo' => 'image|mimes:jpeg,png,jpg,svg|max:5048',
                'profile_address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'city_id' => 'required|integer',
                'region_id' => 'required|integer',
                'country_id' => 'required|integer',
            ]);

        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'description' => 'required|string',
                'photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
                'profile_address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'city_id' => 'required|integer',
                'region_id' => 'required|integer',
                'country_id' => 'required|integer',

            ]);
        }




        return $validator;
    }
}
