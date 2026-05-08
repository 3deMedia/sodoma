<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable=[
        'owner_id',
        'owned_id'
    ];

    public function Owner(){
        return $this->hasOne(Profile::class,'id','owner_id');
    }

    public function Escort(){
        return $this->hasMany(Profile::class,'id','owned_id');

    }
}
