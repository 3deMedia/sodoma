<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'order_id',
        'payment_method',
        'intent',
        'amount',
        'status',
        'email',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
