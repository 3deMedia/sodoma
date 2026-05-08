<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'description',
        'img_file',
        'slug',
        'active'
    ];

    protected $casts = [
        'publish_at' => 'datetime:d-m-Y',
    ];
}
