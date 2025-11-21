<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VipSubscriptionController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 /*Route::get('/testmail',function(){
  Mail::to('lera@3de.es')->send(new TestMail());
  return "Mensaje enviado";
 });
*/

/******* RUTAS VISITANTES SIN LOGEAR  ************/
Route::middleware(['web'])->group(function () {

    Route::get('lang/{lang}', [HomeController::class, 'setLang'])->name('lang');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('escorts/', [HomeController::class, 'index'])->name('show-all-escorts');
    Route::get("escort-{city_slug}/{uid?}/", [HomeController::class, 'showEscorts'])->name('show-escorts');

    Route::get('/homepage', [HomeController::class, 'homePage'])->name('home-page');

    Route::get('links/', [HomeController::class, 'linksPage'])->name('links');
    Route::get('mapa-escorts-{city_slug}', [HomeController::class, 'searchMap'])->name('search.map');

    Route::get('/vips', [HomeController::class, 'showVips'])->name('show-vips');
    Route::get('/pornstars', [HomeController::class, 'showPornstars'])->name('show-pornstars');

    //agencias
    Route::get('/agencias', [HomeController::class, 'showAgencies'])->name('show-agencies');
    Route::get('/agencias/{agency_uid}', [HomeController::class, 'showAnAgency'])->name('show-an-agency');

    // paginas legales
    Route::get('/secure/{page}', [HomeController::class, 'legalPage'])->name('legal.show');

    //mensaje de visitante a escort
    Route::post('/contact-message/{profile}', [HomeController::class, 'sendMessagetoEscort'])->name('send.message.to-escort');

    //Blog
    Route::get('blog/', [HomeController::class, 'showPosts'])->name('show-blog');
    Route::get('blog/{slug}/', [HomeController::class, 'showPost'])->name('show-post');
});

/*********    RUTAS PARA USUARIOS LOGEADOS  ***********/
Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('my-account', [UserController::class, 'myAccount'])->name('my-account');
    Route::get('my-profile', [UserController::class, 'myProfile'])->name('my-profile');
    Route::get('become-vip', [UserController::class, 'becomeVip'])->name('become-vip');
    Route::get('activate-vip', [UserController::class, 'activateVip'])->name('activate-vip')->middleware('can.be.vip');
    Route::get('buy-coins', [UserController::class, 'buyCoins'])->name('buy-coins');
    Route::get('payments', [UserController::class, 'showPayments'])->name('payments');
    Route::get('my-messages', [UserController::class, 'myMessages'])->name('my-messages');
    Route::delete('delete-user-message', [UserController::class, 'deleteMessage']);
    Route::get('/changepassword', [UserController::class, 'changePass'])->name('changepassword');


    //rutas Profile
    Route::resource('profile', ProfileController::class);
    // rutas Escort
    // Route::get('request-photo-review/{photo}',[EscortController::class,'reviewImage'])->name('request-photo-review');
    Route::get('delete-escort-image/{photo}', [ProfileController::class, 'deletePhoto'])->name('delete-escort-image');

    //RUTAS AGENCIA protegidas con middleware
    Route::middleware(['isAgency'])->group(function () {
        Route::get('my-escorts', [AgencyController::class, 'myEscorts'])->name('my-escorts')->middleware('isAgency');
        Route::get('activate-account',[AgencyController::class, 'activateAccount'])->name('activate-account');
        //crud escorts
        Route::post('agency-escort-store', [AgencyController::class, 'storeEscort'])->name('agency.store.escort');
        Route::get('agency-escort-edit/{profile}', [AgencyController::class, 'editEscort'])->name('agency-escort-edit');
        Route::put('agency-escort-update/{profile}', [AgencyController::class, 'updateEscort'])->name('agency-escort-update');
        // Route::delete('agency-escort-form', [AgencyController::class, 'deleteEscort'])->name('agency.storeEscort');
        Route::get('agency-request-photo-review/{photo}', [AgencyController::class, 'reviewEscortImage'])->name('agency-request-photo-review');
        Route::get('agency-delete-escort-image/{photo}', [AgencyController::class, 'deleteEscortImage'])->name('agency-delete-escort-image');


        Route::resource('agency', AgencyController::class);
        // Route::get('api/escort-profile-delete/{profile}',[AgencyController::class,'destroyEscort']);
        Route::get('api/escort-profile-disable/{profile}', [AgencyController::class, 'disableEscort']);
        Route::get('api/escort-profile-enable/{profile}', [AgencyController::class, 'enableEscort']);
    });
    Route::post('user-wants-vip', [VipSubscriptionController::class, 'setProfileVip'])->name('agency-profile-vip');

    // agencia o escort compran vip para ellos mismo desde la pagina "hacerse vip"
    Route::post('upgrade-vip', [VipSubscriptionController::class, 'createVipSubscription']);


    // CRUD COMPRAS DE VIP
    Route::resource('vip-subscription', VipSubscriptionController::class);

    //PAGOS SIMPLES

    // paypal
    Route::post('/checkout/api/paypal/order/create', [PaymentsController::class, 'paypalCheckout'])->name('paypal-checkout');
    Route::post('/payment/capture-paypal-transaction/', [PaymentsController::class, 'paypalCaptureTransaction'])->name('paypal-checkout');


    //stripe
    Route::post('stripe-checkout', [PaymentsController::class, 'stripeCheckout'])->name('stripe-checkout');
    Route::get('success-stripe-payment', [PaymentsController::class, 'processSuccessPayment'])->name('success-stripe-payment');
    Route::get('failure-stripe-payment', [PaymentsController::class, 'processFailurePayment'])->name('failure-stripe-payment');

    //pdf
    Route::get('pdf-payment/{purchase}', [PaymentsController::class, 'showPdf'])->name('pdf-payment');


    // // PAGOS RECURRENTES AKA SUBSCRIPCIONES-> SOLO CON STRIPE

    // Route::post('/billing-portal',[PaymentsController::class,'billingPortal'])->name('agency-subscribes-billing');

    // Usuario cambia contraseña  desde el panel my-account

    Route::put('profile/password', [UserController::class, 'password'])->name('profile.password');

    // contacto de usuario a admin
    //pagina contacto
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    //envia mensaje de pagina de contacto
    Route::post('/contact-us', [HomeController::class, 'contact'])->name('contact');
});


//RUTAS ADMINISTRADOR

Route::middleware(['isAdmin'])->group(function () {

    //usuarios
    Route::get('/admin-dashboard', [UserController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin-users', [AdminController::class, 'showUsers'])->name('admin-users');
    Route::get('/admin-user-delete/{user}', [AdminController::class, 'deleteUser'])->name('admin-user-delete');
    Route::get('/admin-users/{user}', [AdminController::class, 'showUser'])->name('admin-user-show');
    Route::put('/admin-user-update/{user}', [AdminController::class, 'updateUser'])->name('admin-user-update');

    // profile status top and verified
    Route::get('admin-verify/{profile}', [AdminController::class, 'verifyProfile'])->name('admin.verify');

    //Profiles
    Route::get('/admin-profiles/{type}', [AdminController::class, 'showProfiles'])->name('admin-profiles');
    Route::get('/admin-profile/{profile}', [AdminController::class, 'showProfile'])->name('admin-profile-show');
    Route::get('/admin-profile-create/{type}', [AdminController::class, 'createProfile'])->name('admin-profile-create');
    Route::put('admin-change-slug/{profile}', [AdminController::class, 'updateProfileSlug'])->name('admin-change-slug');
    Route::put('admin-profile-update/{profile}', [AdminController::class, 'updateProfile'])->name('admin-profile-update');
    Route::post('/admin-profile-store', [AdminController::class, 'storeProfile'])->name('admin-profile-store');
    Route::get('admin-approve-profile/{profile}', [AdminController::class, 'approveProfile'])->name('approve-profile');
    Route::get('/admin-profile-delete/{profile}', [AdminController::class, 'deleteProfile'])->name('admin-profile-delete');

    Route::get('download-profile-images/{profile}', [AdminController::class, 'downloadImages'])->name('download-profile-images');


    Route::post('/admin-create-vip/{profile}', [AdminController::class, 'createVip'])->name('admin-create-vip');
    Route::get('/admin-delete-vip/{profile}', [AdminController::class, 'deleteVip'])->name('admin-delete-vip');
    // todo-> delete and cambiar por update config
    Route::post('/admin-update-costs', [AdminController::class, 'updateCosts'])->name('admin.update.costs');
    Route::post('/admin-update-config', [AdminController::class, 'updateConfig'])->name('admin.update.config');

    //escorts
    Route::get('admin-delete-image/{photo}', [AdminController::class, 'deletePhoto'])->name('admin-delete-image');

    //Para agencias
    Route::get('/admin-show-agency-escorts/{profile}', [AdminController::class, 'showAgencyEscorts'])->name('admin-show-agency-escorts');
    Route::get('/admin-create-escort-for/{profile}', [AdminController::class, 'createAgencyEscort'])->name('admin-create-escort-for');

    // notis
    Route::get('/admin-notifications', [AdminController::class, 'showNotis'])->name('admin-notifications');

    //revisiones
    Route::get('/admin-reviews', [AdminController::class, 'showRevisions'])->name('admin-revisions');
    Route::get('/admin-photo-reviews', [AdminController::class, 'showPhotoRevisions'])->name('admin-photo-revisions');

    //pagos
    Route::get('/admin-payments', [AdminController::class, 'showPayments'])->name('admin-payments');
    Route::post('/new-transfer', [AdminController::class, 'newTransfer'])->name('new-transfer');
    // TEXTOS CATEGORIAS
    Route::get('/admin-textos-categoria', [AdminController::class, 'showCatTexts'])->name('admin-texts');
    Route::put('/admin-textos-categoria/{catext}', [AdminController::class, 'updateCatTexts'])->name('admin-update-texts');
    Route::post('/admin-textos-categoria', [AdminController::class, 'storeCatTexts'])->name('admin-post-texts');

    // seo config
    Route::get('/admin-seo', [AdminController::class, 'showSeo'])->name('admin-seo');
    Route::put('/admin-seo-update/{param}', [AdminController::class, 'updateSeo'])->name('admin-seo-update');

    //blog
    Route::resource('posts', PostController::class);

    // updating manually
    Route::get('admin-approve-profile-photo/{review}', [AdminController::class, 'approvePhoto'])->name('approve-escort-photo');

    // enviar mensaje a perfil desde zona revisiones
    Route::post('admin-msg-profile/{profile}', [AdminController::class, 'sendMessage'])->name('admin-msg-profile');

    // geolocalizar perfil
    Route::get('admin-geolocate/{profile}', [AdminController::class, 'geoloacate'])->name('geolocate-user');
});


require __DIR__ . '/auth.php';
