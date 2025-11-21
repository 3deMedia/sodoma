<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'address',
        'city_id',
        'region_id',
        'country_id',
        'travel_range_id',
        'latitude',
        'longitude'
    ];

    public function Profile(){
        return $this->hasOne(Profile::class);
    }
    public function Region(){
        return $this->belongsTo(Region::class);
    }
    public function City(){
        return $this->belongsTo(City::class);
    }
}
