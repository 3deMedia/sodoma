<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoReview extends Model
{
    use HasFactory;

    public $timestamps=true;

    protected $table= 'photo_reviews';
    protected $fillable=[
        'profile_id',
        'photo_id'
    ];


    public function Profile(){
        return $this->belongsTo(Profile::class);
    }

    public function Photo(){
        return $this->belongsTo(Photo::class);
    }
}
