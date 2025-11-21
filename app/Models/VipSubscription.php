<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VipSubscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'profile_id',
        'status',
        'ends_at'
    ];

    protected $casts = [
        'ends_at' => 'date:d-m-Y',
    ];



    public function Profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
