<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender' ,
        'profile_id',
        'age' ,
        'height' ,
        'weight' ,
        'breast_size' ,
        'breast_type' , //0 natural,1 silicona
        'hair_color_id' ,
        'eye_color_id' ,
        'languages' ,
        'smoker' ,
        'private_apartament' ,
        'creditcard_acceptance' ,
        'whatsapp_acceptance' ,
        'is_pornstar' ,
        'nationality_id' ,
        'services' ,
    ];

       /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $casts = [
        'languages' => 'array',
        'services' => 'array',
        'smoker' => 'boolean',
        'vacation_mode' => 'boolean',
        'private_apartament' => 'boolean',
        'creditcard_acceptance' => 'boolean',
        'whatsapp_acceptance' => 'boolean',
        'is_pornstar'=> 'boolean',
        'approved'=> 'boolean',
        'is_vip'=> 'boolean',
        'active'=> 'boolean',
        'can_be_reviewed'=> 'boolean',
        'breast_type' =>'boolean'
    ];


    public function Profile(){
        return $this->hasOne(Profile::class);
    }

    public function Eyes(){
        return DB::table('eye_colors')->where('id',$this->eye_color_id)->first()->name;
    }
    public function Hair(){
        return DB::table('hair_colors')->where('id',$this->hair_color_id)->first()->name;
    }

}
