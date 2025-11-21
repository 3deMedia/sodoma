<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_amounts', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedInteger('coins');
            $table->unsignedInteger('euros');
            $table->string('stripe_price_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_amounts');
    }
}
