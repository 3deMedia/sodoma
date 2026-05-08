<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('profile_type_id');
            $table->foreign('profile_type_id')->references('id')->on('profile_types');
            $table->unsignedInteger('cost')->comment('coste en coins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_rates');
    }
}
