<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAmount extends Model
{
    use HasFactory;

    protected $fillable=['text','coins','euros','stripe_price_id'];

    Public $timestamps=false;
}
