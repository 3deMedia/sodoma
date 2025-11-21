<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('gender');
            $table->unsignedSmallInteger('age');
            $table->unsignedSmallInteger('height');
            $table->unsignedSmallInteger('weight')->nullable();
            $table->unsignedSmallInteger('breast_size')->nullable();
            $table->unsignedSmallInteger('breast_type')->nullable();
            $table->foreignId('nationality_id')->nullable()->constrained();
            $table->foreignId('hair_color_id')->nullable()->constrained();
            $table->foreignId('eye_color_id')->nullable()->constrained();
            $table->text('languages')->nullable();
            $table->boolean('smoker')->default(0)->nullable();
            $table->boolean('is_pornstar')->default(0)->nullable();
            $table->text('services');
            $table->boolean('private_apartament')->default(0);
            $table->boolean('creditcard_acceptance')->default(1);
            $table->boolean('whatsapp_acceptance')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
