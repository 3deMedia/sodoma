<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public $timestamps= false;

    protected $fillable=[
        'profile_id',
        'profile_type',
        'filename',
        'approved',
        'is_main',
        'path',
    ];


}
