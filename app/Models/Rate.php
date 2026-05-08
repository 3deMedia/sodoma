<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public $timestamps= false;

    protected $fillable=[
        'profile_id',
        'one_hour',
        'added_hour',
        'half_day',
        'half_hour',
        'one_day'
    ];

}
