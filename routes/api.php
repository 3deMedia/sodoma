<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// regiones para los formularios de registro de un nuevo perfil
Route::get('ajax-regions',function(Request $request){
    $name = $request->query('search');
    $country_id = $request->query('country');
    $regions=DB::table('regions')->where('country_id',$country_id)->where('name','like',"%$name%")->get();

    return response()->json($regions,200);
});

// ciudades para registro de un nuevo perfil
Route::get('ajax-cities',function(Request $request){
    $name = $request->query('search');
    $region_id = $request->query('region');
    $cities=DB::table('cities')->where('region_id',$region_id)->where('name','like',"%$name%")->get();

    return response()->json($cities,200);
});

// Visitas a perfil

// Route::get('escorts/{escort}/register-visit',[ApiController::class,'escortVisited']);
// Route::get('agencies/{agency}/register-visit',[ApiController::class,'agencyVisited']);

