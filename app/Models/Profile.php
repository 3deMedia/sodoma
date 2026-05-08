<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id', // 1 escort ,2 agencia,5 admin
        'name',
        'email',
        'phone',
        'description',
        'uid',
        'web',
        'approved',
        'is_vip',
        'top',
        'verified',
        'active', // si es visible o no para los visitantes, solo para escorts manejadas por agencias
        'can_be_reviewed',
        'hide_face',
        'monthly_agency_period' // la agencia tiene comprada la subscripcion para ser visible a los usuarios . Null o fecha
        ];
           /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $casts = [
        'approved'=> 'boolean',
        'is_vip'=> 'boolean',
        'active'=> 'boolean',
        'can_be_reviewed'=> 'boolean',
    ];


        public function User (){
            return $this->belongsTo(User::class);
        }

        public function Features(){
            return $this->hasOne(Feature::class);
        }
        public function Address(){
            return $this->hasOne(Address::class);
        }

        public function Photos(){
            return $this->hasMany(Photo::class);
        }

        public function MainPhoto(){
            return $this->Photos()->where('is_main',1)->first();
        }

        public function Videos(){
            return $this->hasMany(Video::class);
        }

        public function Rates(){
            return $this->hasOne(Rate::class);
        }

        public function Messages(){
            return $this->hasMany(ContactMessage::class);
        }

        public function Vips(){
            return $this->hasMany(VipSubscription::class);
        }
        public function Vip(){
            return $this->Vips()->where('status',1)->first();
        }
        public function Escorts(){
            return $this->hasManyThrough(Profile::class,Ownership::class,'owner_id','id','id','owned_id');
        }
        public function Owner(){
            return $this->hasOneThrough(Profile::class,Ownership::class,'owned_id','id','id','owner_id');
        }
        // confirmar que pertenece a alguna agencia
        public function IsOwned(){
            return $this->hasOne(Ownership::class,'owned_id','id');
        }
        public function Coordinates(){
            return $this->hasOne(Coordinates::class);
        }


        public function Vzt(){
            return visits($this);
        }
        public function Visits()
        {
            return visits($this)->relation();
        }

}


