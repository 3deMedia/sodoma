<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Mail\ContactMail;
use App\Models\BannedUser;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\VerifyMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // el email es malun
        // el password es polin
        // el user_type_id es fikal

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',

        [  
            'secret' => '6Le3P9oqAAAAAFMrcd7VVdx4FINsQtRZ68DJy-pO',        
            'response' => $request->input('g-recaptcha-response')
            
        ])->object();

    
        if ($request->email) {
            return redirect(RouteServiceProvider::HOME);
        }
        $request->validate([
            'malun' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fikal' => ['required'],
            'accept_policy' => ['required']
        ]);


        $isBanned = BannedUser::where('email', $request->malun)->exists();

        if ($isBanned) {
            return redirect()->route('home');
        }      

        if($response->success && $response->score >= 0.7){
            

            $user = User::create([
                'user_type_id' => intval($request->fikal),
                'email' => $request->malun,
                'password' => Hash::make($request->password),
            ]); 

        event(new Registered($user)); // el metodo original para enviar email verifications

        /* Envío de emails de aviso de registro de nuevo usuario*/
        $data = (object)[
            'name' => 'Secrets',
            'email' => $request->malun,
            'message' =>  'newuser',
        ];
        
        Mail::to('lera@3de.es')->send(new ContactMail($data));   

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
       } else {
           return redirect(RouteServiceProvider::HOME);
        }
    }
}
