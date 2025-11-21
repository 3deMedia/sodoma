<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->foreignId('city_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->foreignId('travel_range_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
