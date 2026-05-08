<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categtext extends Model
{
    use HasFactory;

    protected $table='categories_text';

    protected $fillable=[
        'name',
        'description_1',
        'description_2'
    ];
}
