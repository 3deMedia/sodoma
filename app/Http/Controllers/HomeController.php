<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Post;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function __construct()
    {
    }
    //pagina inicio visitantes
    public function index(Request $request)
    {
        $seo = DB::table('seo_config')->find(5);

        $search = $request->query('q');
        $grouped_escorts = Profile::has('Features')
            ->where('approved', 1)
            ->where('type_id', 1)
            ->where('active', 1)
            ->where('verified', 1)
            ->orderBy('is_vip', 'desc')->limit(10)
            ->get()
            ->groupBy('is_vip');
        $escorts_found = true;

        if ($search) {
            $query_grouped_escorts = Profile::has('Features')
                ->where('approved', 1)
                ->where('type_id', 1)
                ->where('description', 'LIKE', '%' . $search . '%')
                ->where('active', 1)
                ->orderBy('is_vip', 'desc')
                ->get()
                ->groupBy('is_vip');
            if ($query_grouped_escorts->count()) {
                $grouped_escorts = $query_grouped_escorts;
            }

        }


        return view('guest.escorts', compact('grouped_escorts', 'seo', 'escorts_found'));
    }


    public function setLang(Request $request)
    {

        $locale = $request->lang;
        if (!$locale or !in_array($locale, config('app.available_locales'))) {

            return back();
        }

        app()->setLocale($locale);

        session()->put('locale', $locale);

        return back();
    }

    //inicio con subpaths
    public function showEscorts(Request $request, $city_slug = null, $uid = null)
    {

        // preparamos una colleccion aleatoria por si el resto falla
        $search = $request->query('q');

        $grouped_escorts = Profile::has('Features')
            ->where('approved', 1)
            ->where('type_id', 1)
            ->where('active', 1)
            ->orderBy('is_vip', 'desc')
            ->get()
            ->groupBy('is_vip');
        $escorts_found = false;

        $city = DB::table('cities')->where('slug', $city_slug)->first();
        $seo = DB::table('seo_config')->find(6);

        if ($city_slug) {

            $city_url = $request->path();
            $city_path = "/" . $city_url . "/";

            $seo = DB::table('seo_config')->where('route', $city_path)->first();

            if ($city) {

                if ($uid) {
                    $seo = DB::table('seo_config')->find(7);

                    $profile = Profile::where('approved', 1)
                        ->where('type_id', 1)
                        ->where('active', 1)
                        ->where('uid', $uid)->first();
                    if ($profile) {
                        // creada la nueva variable para las escorts relaciondas
                        $related_escorts = Profile::whereHas('Address', function ($query) use ($city) {
                            return $query->where('city_id', $city->id);
                        })->where('approved', 1)
                            ->where('type_id', 1)
                            ->where('active', 1)
                            ->where('id', '!=', $profile->id)
                            ->inRandomOrder()->limit(4)
                            ->get();

                        // mapa

                        $center = (object) ['lat' => floatval($profile->Address->latitude), 'lng' => floatval($profile->Address->longitude)];

                        // end mapa
                        $is_ignored = ignoredPhotoMax($profile->id);

                        return view('guest.escort-show', compact('profile', 'seo', 'related_escorts', 'center', 'is_ignored'));
                    } else {
                        return redirect()->route('show-all-escorts');
                    }

                } else {
                    if ($search) {
                        $city_grouped_escorts = Profile::whereHas('Address', function ($query) use ($city) {
                            return $query->where('city_id', $city->id);
                        })->where('approved', 1)
                            ->where('active', 1)
                            ->where('type_id', 1)
                            ->where('description', 'LIKE', '%' . $search . '%')
                            ->orWhere('name', 'LIKE', '%' . $search . '%')
                            ->orderBy('is_vip', 'desc')
                            ->get()
                            ->groupBy('is_vip');
                        if ($city_grouped_escorts->count()) {
                            $grouped_escorts = $city_grouped_escorts;
                            $escorts_found = true;
                        }
                    } else {
                        $city_grouped_escorts = Profile::whereHas('Address', function ($query) use ($city) {
                            return $query->where('city_id', $city->id);
                        })->where('approved', 1)
                            ->where('active', 1)
                            ->where('type_id', 1)
                            ->orderBy('is_vip', 'desc')
                            ->get()
                            ->groupBy('is_vip');
                        if ($city_grouped_escorts->count()) {
                            $grouped_escorts = $city_grouped_escorts;
                            $escorts_found = true;
                        }
                    }

                }
            }
        }

        return view('guest.escorts', compact('grouped_escorts', 'seo', 'city', 'escorts_found'));
    }
    /*  PAGINA ¨HOMEPAGE  */



    //pagina inicio visitantes
    public function homePage(Request $request)
    {
        $seo = DB::table('seo_config')->find(5);

        $grouped_escorts = Profile::has('Features')
            ->where('approved', 1)
            ->where('type_id', 1)
            ->where('active', 1)
            ->where('is_vip', 1)
            ->orderBy('is_vip', 'desc')
            ->get()
            ->groupBy('is_vip');

        return view('guest.homepage', compact('grouped_escorts', 'seo'));
    }

    public function searchMap(Request $request, $city_slug)
    {

        $city = DB::table('cities')->where('slug', $city_slug)->first();

        if ($city) {

            $center = (object) ['lat' => floatval($city->latitude), 'lng' => floatval($city->longitude)];
            $escorts = Profile::where([
                'type_id' => 1,
                'approved' => 1,
                'active' => 1
            ])
                ->whereHas('Address', function ($q) use ($city) {
                    return $q->where('city_id', $city->id);
                })->get();
            $geo_escorts = [];
            if ($escorts->count()) {
                foreach ($escorts as $escort) {
                    $image = config('app.url') . '/storage/escort_photos/' . $escort->Mainphoto()->path . '/' . $escort->Mainphoto()->filename;
                    $price = $escort->Rates->one_hour;
                    $link = route('show-escorts', ['city_slug' => $city_slug, 'uid' => $escort->uid]);
                    $lat = floatval($escort->Address->latitude);
                    $long = floatval($escort->Address->longitude);
                    $data = (object) ['name' => $escort->name, 'image' => $image, 'price' => $price, 'lat' => $lat, 'lng' => $long, 'link' => $link];
                    array_push($geo_escorts, $data);
                }
            }
        } else {
            return redirect()->route('home');
        }
        return view('guest.map', compact('center', 'geo_escorts', 'city'));

    }


    // /**
    //  * Muestra una escort
    //  *
    //  * @param Request $request
    //  * @param string $escort_url
    //  * @return void
    //  */
    // public function showAnEscort(Request $request, string $region_slug, string $escort_uid)
    // {
    //     $region = Region::where('slug','like',"%$region_slug%")->first();

    //     $profile = Profile::where('type_id',1)->where('uid', $escort_uid)->first();
    //     $profile->Vzt()->increment();

    //     dd($profile);

    //     return abort(403);
    // }




    /**
     * Muestra las agencias
     *
     * @param Request $request
     * @return void
     */
    public function showAgencies(Request $request)
    {
        $seo = DB::table('seo_config')->find(8);
        $agencies = Profile::where('type_id', 2)->where('approved', 1)->whereNotNull('monthly_agency_period')->inRandomOrder()->get();
        return view('guest.agencies', compact('agencies', 'seo'));
    }

    /**
     * Muestra una agencia
     *
     * @param Request $request
     * @param [type] $agency_url
     * @return void
     */
    public function showAnAgency(Request $request, $agency_url)
    {
        $seo = DB::table('seo_config')->find(9);
        $profile = Profile::where('type_id', 2)->where('uid', $agency_url)->first();
        if ($profile) {
            $profile->Vzt()->increment();
            if ($profile->approved && $profile->monthly_agency_period) {
                // mapa

                $center = (object) ['lat' => floatval($profile->Address->latitude), 'lng' => floatval($profile->Address->longitude)];


                return view('guest.agency-show', compact('profile', 'seo', 'center'));
            }
        }

        return view('errors.404');
    }

    /* Links Page */
    public function linksPage()
    {
        $seo = DB::table('seo_config')->find(19);
        $exists = view()->exists("guest.links");
        if ($exists) {
            return view('guest.links', compact('seo'));
        } else {
            return view('errors.404');
        }
    }


    //paginas legales +cookies +pago seguro
    public function legalPage(Request $request, $page)
    {

        $exists = view()->exists("legal.$page");
        if ($exists) {
            $seo = DB::table('seo_config')->where('view', $page)->first();
            return view("legal.$page", compact('seo'));
        } else {
            return view('errors.404');
        }
    }

    // pagina de contacto
    public function contactUs(Request $request)
    {
        $seo = DB::table('seo_config')->find(11);
        $profile = $request->user()->Profile();
        return view('user.contact', compact('seo', 'profile'));
    }

    // nos envia el mensaje dl visitante al admin
    public function contact(Request $request)
    {

        $request->validate([
            'phone' => 'required',
            'name2' => 'required',
            'email2' => ['required', 'email'],
            'message2' => 'required'
        ]);


        $data = (object) [
            'name' => $request->name2,
            'email' => $request->email2,
            'phone' => $request->phone,
            'message' => $request->message2,
            'link' => route('admin-user-show', $request->user()->id)
        ];

        if ($data->name && $data->email) {
            Mail::to('lera@3de.es')->send(new ContactMail($data));
        }

        return redirect()->back()->with('success', 'Message Sent');

    }

    /**
     * Mensaje de visitante a escort
     *
     * @param Request $request
     * @param Escort $escort
     * @return void
     */
    // public function sendMessagetoEscort(Request $request, Profile $profile)
    // {

    //     $request->validate([
    //         'message' => 'required',
    //         'email' => 'required|email',
    //     ]);
    //     $agency_id =  $escort->Agency ? $agency_id = $escort->Agency->id : null;
    //     try {
    //         ContactMessage::create([
    //             'agency_id' => $agency_id,
    //             'escort_id' => $escort->id,
    //             'email' => $request->email,
    //             'message' => $request->message,
    //         ]);
    //     } catch (\Throwable $th) {
    //         return back()->with('error', Lang::get('general.message_not_sent'));
    //     }



    //     return back()->with('success', Lang::get('general.message_sent'));
    // }

    /**
     * COntrola la buscuqeda de escorts si han utilizado los filtros
     *
     * @param Request $request
     * @param [type] $type
     * @return void
     */
    public function filterSearch(Request $request, $type = null)
    {
        $seo = DB::table('seo_config')->find(10);


        $sql = $this->buildSqlFilter($request);

        if ($type) {

            $grouped_escorts = Profile::whereRaw("approved = 1" . $sql . " and active = 1")
                ->where('is_pornstar', 1)
                ->orderBy('is_vip', 'desc')
                ->get()
                ->groupBy('is_vip');
        } else {
            $grouped_escorts = Profile::whereRaw("approved = 1" . $sql . " and active = 1")
                ->orderBy('is_vip', 'desc')
                ->get()
                ->groupBy('is_vip');
        }




        if ($grouped_escorts->count() == 0) {

            $grouped_escorts = Profile::where('approved', 1)
                ->where('active', 1)
                ->where('type_id', 1)
                ->orderBy('is_vip', 'desc')
                ->get()
                ->groupBy('is_vip');

            return view('guest.home', compact('grouped_escorts', 'seo'))->with('no_results', 'No results found');
        }

        return view('guest.home', compact('grouped_escorts', 'seo'));
    }

    public function buildSqlFilter(Request $request)
    {
        $age = $request->age;
        $sex = $request->genre;
        $breast = $request->breast_size;
        $weight = $request->weight;
        $height = $request->height;

        $filter = "";

        $filter = ($sex === "0" || $sex === "1") ? $filter . " and gender = $sex" : $filter;


        switch ($age) {
            case 1:
                $filter = $filter . " and age < 26";
                break;
            case 2:
                $filter = $filter . " and age BETWEEN 26 AND 35";
                break;
            case 3:
                $filter = $filter . " and age BETWEEN 36 AND 45";
                break;
            case 4:
                $filter = $filter . " and age BETWEEN 46 AND 55";
                break;
            case 5:
                $filter = $filter . " and age > 55";
                break;
        }

        switch ($breast) {
            case 1:
                $filter = $filter . " and breast_size < 70";
                break;
            case 2:
                $filter = $filter . " and breast_size BETWEEN 71 AND 85";
                break;
            case 3:
                $filter = $filter . " and breast_size BETWEEN 86 AND 100";
                break;
            case 5:
                $filter = $filter . " and breast_size > 100";
                break;
        }

        switch ($weight) {
            case 1:
                $filter = $filter . " and weight BETWEEN 40 AND 50";
                break;
            case 2:
                $filter = $filter . " and weight BETWEEN 51 AND 60";
                break;
            case 3:
                $filter = $filter . " and weight BETWEEN 61 AND 70";
                break;
            case 4:
                $filter = $filter . " and weight BETWEEN 71 AND 80";
                break;
            case 5:
                $filter = $filter . " and weight BETWEEN 81 AND 90";
                break;
            case 6:
                $filter = $filter . " and weight > 90";
                break;
        }

        switch ($height) {
            case 1:
                $filter = $filter . " and height BETWEEN 150 AND 160";
                break;
            case 2:
                $filter = $filter . " and height BETWEEN 161 AND 170";
                break;
            case 3:
                $filter = $filter . " and height BETWEEN 171 AND 180";
                break;
            case 4:
                $filter = $filter . " and height BETWEEN 181 AND 190";
                break;
            case 5:
                $filter = $filter . " and age > 190";
                break;
        }
        return $filter;
    }

    /**BLOG */

    public function showPosts(Request $request)
    {

        $seo = DB::table('seo_config')->find(12);
        $posts = Post::where('active', 1)->whereDate('publish_at', '<=', Carbon::today())->orderBy('created_at', 'desc')->paginate('50');

        return view('guest.blog.index', compact('posts', 'seo'));
    }

    public function showPost(Request $request, $slug)
    {
        $today = Carbon::today()->endOfDay();

        $post = Post::where([
            ['slug', $slug],
            ['active', 1],
            ['publish_at', '<=', $today]
        ])->first();

        if ($post) {
            return view('guest.blog.show', compact('post'));
        }

        return view('errors.404');

    }
}
