<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_type_id',
        'email',
        'password',
        'coins',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function Profiles(){
        return $this->hasMany(Profile::class);
    }

    public function Profile(){
        $user_type= $this->user_type_id;
        return $this->Profiles()->where('type_id',$user_type)->first();
    }
    public function Escorts(){
        return $this->Profiles()->where('type_id',1)->get();
    }

    public function Purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function EscortExpenses(){
        return $this->hasManyThrough(VipSubscription::class,Profile::class);
    }
    public function AgencyExpenses(){
        return $this->hasManyThrough(AgencyBanner::class,Profile::class);
    }

    public function isAdmin(){

        return $this->user_type_id === 5;

    }

}
