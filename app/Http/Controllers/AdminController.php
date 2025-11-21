<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Categtext;
use App\Models\Configuration;
use App\Models\ContactMessage;
use App\Models\Feature;
use App\Models\Ownership;
use App\Models\Photo;
use App\Models\PhotoReview;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Purchase;
use App\Models\Rate;
use App\Models\User;
use App\Models\VipSubscription;
use App\Notifications\VipPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Normalizer\SlugNormalizer;
use ZipArchive;

class AdminController extends Controller
{


    public function __construct(Request $request)
    {
        $this->middleware('isAdmin');
    }

    /****  FUNCIONES SHOW  ******/


    public function showUsers(Request $request)
    {

        $users = User::all()->except([1]);
        return view('admin.users.index', compact('users'));
    }

    public function showUser(Request $request, User $user)
    {


        return view('admin.users.show', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {

        if ($request->filled('contrasena')) {
            $request['password'] = Hash::make($request->contrasena);
        }
        $user->update($request->all());
        return back();
    }

    public function verifyProfile(Request $request,Profile $profile){

        $verified = !$profile->verified;

        $profile->update(['verified'=>$verified]);

        return back();
    }



    public function showCatTexts(Request $request){

        $category_texts=Categtext::all();

        return view('admin.texts.index',compact('category_texts'));

    }

    public function updateCatTexts(Request $request, Categtext $catext){

        $catext->update($request->all());
        return back();

    }
    public function storeCatTexts(Request $request){

        Categtext::create($request->all());
        return back();
    }


    public function showProfile(Request $request, Profile $profile)
    {
        $new_escort_cost= escortCost();
        $agency_cost =agencyCost();
        return view('admin.profiles.show', compact('profile','new_escort_cost','agency_cost'));
    }



    public function showProfiles(Request $request,$type)
    {
        $type_id = $type=='1'? 1:0;

        $profiles = Profile::where('type_id',$type)->where('approved',1)->get();
        return view('admin.profiles.index', compact('profiles'));

    }

    public function downloadImages(Request $request, Profile $profile){

        $zip = new ZipArchive();

        $folder= $profile->type_id == 1 ? 'escort_photos':'agency_photos';

        if(! File::exists(storage_path('downloads/imagenes.zip'))){
            File::makeDirectory(storage_path('downloads'),0755,true);
        }


        $cancreate=$zip->open(storage_path().'/downloads/imagenes.zip', ZipArchive::CREATE);
        if ($cancreate === TRUE)
        {
            foreach ($profile->Photos as $key=>$photo) {
            $path=storage_path()."/app/public/".$folder."/".$photo->path."/".$photo->filename;

               $added=  $zip->addFile($path,basename($path));

            }
            $zip->close();

        }

        return response()->download(storage_path("/downloads\imagenes.zip"));
    }



 //ZONA   AGENCIAS //



    // ver escorts deagencia
    public function showAgencyEscorts(Request $request, Profile $profile)
    {

        return view('admin.agencies.show-escorts', compact('profile'));
    }


    /// ZONA NOTIFIACIONES //

    public function showNotis(Request $request)
    {

        $notis = User::find(1)->unreadNotifications;
        return view('admin.notifications.index', compact('notis'));
    }

    /// ZONA rEVISIONES ///

    public function showRevisions(Request $request)
    {

        $profiles = Profile::where('approved',0)->get();
        return view('admin.profiles.pending', compact('profiles'));
    }





    public function showPhotoRevisions(Request $request)
    {

        $revs = PhotoReview::all();
        return view('admin.reviews.fotos', compact('revs'));
    }

    /////////// ZONA PAGOS ///////////

    public function showPayments(Request $request)
    {

        $purchases = Purchase::all();

        return view('admin.payments.index', compact('purchases'));
    }

    public function newTransfer(Request $request){

        Purchase::create($request->all());

        return redirect()->route('admin-payments');
    }

    /////////// ZONA SEO ///////////
    public function showSeo(Request $request)
    {

        $seo_pages = DB::table('seo_config')->get();

        return view('admin.seo.index', compact('seo_pages'));
    }

    public function updateSeo(Request $request,int $param)
    {

        $seo_page = DB::table('seo_config')->where('id',$param)->update([
            'seo_title'=>$request->seo_title,
            'seo_description'=>$request->seo_description,
        ]);


        return back();
    }

    /***BLOG  */
    public function showPosts(Request $request)
    {

        $posts = Post::all();

        return view('admin.blog.index', compact('posts'));
    }

    /****  FUNCIONES CREATE  ******/



    public function createProfile(Request $request,$type)
    {
        return view('admin.profiles.create',compact('type'));
    }

    //creacion de escort
    public function createAgencyEscort(Request $request, Profile $profile)
    {

        return view('admin.agencies.create-escort', compact('profile'));
    }

    // creacion usuarios tipo






    /****  FUNCIONES STORE  ******/


    public function storeProfile(Request $request)
    {
        $user_type= $request->user_type_id;
        $for_profile=$request->for_profile ? intval($request->for_profile):false;
        $request['address']=$request->profile_address;
        if ($user_type == 1) {

            $validator = $this->validateEscortForm($request);
        } else {

            $validator = $this->validateAgencyForm($request);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            if($for_profile){

              $user= Profile::where('id',$for_profile)->first()->User;
            }else{

                $user =  User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->email),
                    'email_verified_at' => now(),
                    'user_type_id' => $request->user_type_id,
                    'email_verified_at'=>now()
                ]);
            }

        } catch (\Throwable $th) {

            return  back()->with('error', $th->getMessage());
        }

        try {
            $uid= $this->createProfileUid($request->name);

            $profile = Profile::create([
                'user_id' => $user->id,
                'type_id' => $user_type,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => $request->description,
                'uid'=>$uid
            ]);
            $request['profile_id'] = $profile->id;
            if($for_profile){
                $owner= $user->Profile()->id;
                Ownership::create([
                    'owner_id'=>$owner,
                    'owned_id'=>$profile->id
                ]);
            }

            if($user_type==1){
                $request['nationality_id'] = $request->nationality_id =='null' ? null:$request->nationality_id;
                Feature::create($request->all());
                Rate::create($request->all());
            }
            $request['address']=$request->profile_address;
            Address::create($request->all());

            $this->storePhotos($request, $user_type);
        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }

        return redirect()->route('admin-dashboard')->with('success', 'Bien hecho');
    }



    public function storePhotos(Request $request, $profile_type)
    {

        $year = now()->year;
        $month = now()->month;
        $path = $profile_type == 1 ? 'public/escort_photos' : 'public/agency_photos';
        $images = $profile_type == 1 ?$request->file('photos'):[$request->file('photo')];
        foreach ($images as $key => $img) {


            $extension = $img->getClientOriginalExtension();
            $filename = time() . "$key." . $extension;

            try {
                if ($key == 0) {
                    Photo::create([
                        'profile_id' => $request->profile_id,
                        'filename' => "$filename",
                        'path' => "$year/$month",
                        'is_main' => 1,
                        'approved' => 1
                    ]);
                } else {
                    Photo::create([
                        'profile_id' => $request->profile_id,
                        'filename' => "$filename",
                        'path' => "$year/$month",
                        'approved' => 1

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






    /****  FUNCIONES UPDATE  ******/

    public function updateProfile(Request $request, Profile $profile)
    {

        $message = Lang::get('general.update_success');
        $status = 'success';

        // update image if necessary
        $images = $profile->type_id == 1 ? $request->file('photos') : $request->file('photo');

        if ($images) {
            $request->validate([
                'photos.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);
            $this->updatePhotos($request, $profile);
        }

        try {
            // $active= $request->active == "1" ? 1 :0;
            $profile->update($request->all());
            if($request->active=="0" && $profile->type_id==2 ){
                $this->hideEscorts($profile);
            }
            if($request->active=="1" && $profile->type_id==2){
                $this->activateEscorts($profile);
            }
            if ($profile->type_id == 1) {
                $profile->Photos()->update(['approved' => 1]);
                $profile->Rates->update($request->all());
                $profile->Features->update($request->all());
                $old_main_photo = $profile->Photos->where('is_main', 1)->first();
                $form_main_photo_id = intval($request->main_photo);

                if ($form_main_photo_id !== $old_main_photo->id) {

                    $old_main_photo->update(['is_main' => 0]);
                    Photo::find($form_main_photo_id)->update(['is_main' => 1]);
                }
            }
            $request['address']=$request->profile_address;
            $profile->Address->update($request->all());
        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }

        return back()->with($status, $message);
    }


    public function activateEscorts( Profile $profile){
        $escorts= $profile->Escorts()->update(['active'=>1]);

    }

    public function hideEscorts( Profile $profile){

         $profile->Escorts()->update(['active'=>0]);

    }

    public function updateProfileSlug(Request $request, Profile $profile){

        $normalizer= new SlugNormalizer();
        $new_slug= $normalizer->normalize($request->slug);

        $slugAlreadyExist = Profile::where('uid', $new_slug)->exists();
        if($slugAlreadyExist){
            return redirect()->back()->with('error','Slug ya existe, selecciona otro');
        }else{

            $profile->update(['slug'=>$new_slug]);
        }
        return back()->with('success','Slug modificado');

    }



    public function updatePhotos(Request $request, Profile $profile)
    {
        $year = now()->year;
        $month = now()->month;
        if ($profile->type_id == 1) {
            $images =  $request->file('photos');
            $path = 'public/escort_photos';
            $is_main = 0;
        } else {
            $is_main = 1;
            $images = [$request->file('photo')];
            $path = 'public/agency_photos';
            $photo = $profile->MainPhoto();
            $filepath = "$path/$photo->path/$photo->filename";
            Storage::delete($filepath);
            if ($photo->Review) {
                $photo->Review->delete();
            }

            $photo->delete();
        }

        foreach ($images as $key => $img) {

            $path = $profile->type_id == 1 ? 'public/escort_photos' : 'public/agency_photos';
            $extension = $img->getClientOriginalExtension();
            $filename = time() . "$key." . $extension;
            // si es la primera vez que usuario sube fotos, la primera foto subida sera la principal de perfil.

            Photo::create([
                'profile_id' => $profile->id,
                'filename' => $filename,
                'approved' => 1,
                'path' => "$year/$month",
                'is_main' => $is_main
            ]);


            $img->storeAs("$path/$year/$month", $filename);
        }
    }


    public function updateCosts(Request $request){
        $type =$request->profile_type_id;

        $cost= $request->cost;

        DB::table('subscription_rates')->where('profile_type_id',$type)->update(['cost'=>$cost]);

        return back();
    }

    public function updateConfig(Request $request){

        foreach ($request->except('_token') as $key => $input) {

            Configuration::where('name',$key)->first()->update(['value'=>$input]);
        }


        return back();
    }








    //APROVACIONES

    public function approveProfile(Request $request,Profile $profile)
    {




        if($profile->type_id==1){
            $profile->Photos()->update(['approved'=>1]);
        }else{
            $profile->MainPhoto()->update(['approved'=>1]);
        }
        if($profile->type_id==1){
            $profile->update(['active'=>1]);
        }
        $profile->update(['approved' => 1]);


        return redirect()->route('admin-revisions')->with('success', 'perfil aprobado');
    }



    public function approvePhoto(Request $request, PhotoReview $review)
    {

        $review->Photo->update(['approved' => 1]);
        $review->delete();
        return back();
    }






    //deletes


    public function deleteUser(Request $request, User $user){
        $profile=$user->Profile();
        if($profile){
            $profile->delete();
        }
        return back();
    }

    public function deleteProfile(Request $request, Profile $profile){

        try {
            $profile->delete();
           $msg= 'Borrado';
           $status= 'success';

        } catch (\Throwable $th) {
           $msg= $th->getMessage();
           $status= 'error';

        }


        return back()->with($status,$msg);
    }

    public function deletePhoto(Request $request, Photo $photo)
    {
        $profile = Profile::find($photo->profile_id);
        if ($profile->Photos->count() == 1 || $photo->is_main) {
            return back();
        }

        Storage::delete("public/escort_photos/$photo->path/$photo->filename");
        $photo->delete();

        return back();
    }


    //suscripciones VIp al crear "NO ELIMINA MONEDAS"

    public function createVip(Request $request, Profile $profile)
    {


        $user=$profile->User;
        $type = $profile->type_id;
        $cost = $type==1 ? escortCost():agencyCost();

        $amount_left = $user->coins - $cost;

        if($amount_left<0){
            $status = 500;
            $message = 'No tiene coins';
            return response()->json($message, $status);
        }


        $months = intval($request->months);
        $ends_at = Carbon::now()->addMonths($months);
        try {
            $vip_su = VipSubscription::create([
                'profile_id' => $profile->id,
                'status' => 1,
                'ends_at' => $ends_at
            ]);
            $status = 200;
            $message = 'Correcto';

            $profile->update(['is_vip' => 1]);



        } catch (\Throwable $th) {
            $status = 500;
            $message = $th->getMessage();
        }
        try {
            $admin = User::find(1);
            $noti_vip = (object)[
                'profile_id' => $profile->id,
                'purchase_id' => $vip_su->id,
            ];

            $admin->notify(new VipPurchase($noti_vip));
        } catch (\Throwable $th) {
            $status = 500;
            $message = $th->getMessage();
        }
        return response()->json($message, $status);
    }


    public function deleteVip(Request $request, Profile $profile)
    {
        $subscription = $profile->Vip();

        if ($subscription) {
            $subscription->update(['status'=>0]);
        }
        $profile->update(['is_vip' => 0]);
        return back();
    }


    // ENVIAR MENSAJE CORREO A USUARIO (DESDE ZONA REVISIONES)
    public function sendMessage(Request $request,Profile $profile)
    {


        ContactMessage::create([
            'profile_id'=>$profile->id,
            'email'=>'Administración',
            'message'=>$request->message
        ]);

        return back()->with('success', 'Message Sent');
    }

    // public function geoloacate(Request $request,Profile $profile){

    //     $address= $profile->Address->address;
    //     $city= $profile->Address->City->name;

    //     $full_address="$address,+$city";
    //     $api_key= env('MAPS_GOOGLE_MAPS_ACCESS_TOKEN2');
    //     $response= Http::get("https://maps.googleapis.com/maps/api/geocode/json?address=$full_address&key=$api_key");
    //     $json_data=$response->json();

    //         if($json_data['results']){
    //             $profile->update(['geocoded'=>1]);

    //             if($profile->type_id==2){
    //                 if($profile->Escorts()->count()){
    //                     foreach ($profile->Escorts() as $escort ) {
    //                         Coordinates::create([
    //                             'profile_id'=>$escort->id,
    //                             'latitude'=>$json_data["results"][0]["geometry"]["location"]['lat'],
    //                             'longitude'=>$json_data["results"][0]["geometry"]["location"]['lng'],
    //                         ]);
    //                     }
    //                 }
    //             }

    //             Coordinates::create([
    //                 'profile_id'=>$profile->id,
    //                 'latitude'=>$json_data["results"][0]["geometry"]["location"]['lat'],
    //                 'longitude'=>$json_data["results"][0]["geometry"]["location"]['lng'],
    //             ]);
    //         }


    //     return back();

    // }


    /****** VALIDACIONES *** */

    public function validateEscortForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles,email',
            'phone' => 'required|string',
            'description' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'address' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'country_id' => 'required',
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

    public function validateAgencyForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles,email',
            'phone' => 'required|string',
            'description' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'address' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'country_id' => 'required',
        ]);
        return $validator;
    }
}
