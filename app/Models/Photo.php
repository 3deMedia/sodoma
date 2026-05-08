<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;

class Photo extends Model
{
    use HasFactory;
    public $timestamps= false;

    protected $fillable=[
        'profile_id',
        'filename',
        'approved',
        'is_main',
        'path',
        'type', // 0-normal o 1-logo
        'orientation'
    ];

    public function Review(){
        return $this->hasOne(PhotoReview::class);
    }

    public function Profile(){
        return $this->belongsTo(Profile::class);
    }

}
