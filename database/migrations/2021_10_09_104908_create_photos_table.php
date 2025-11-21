<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->onDelete("cascade");
            $table->string('filename');
            $table->string('path');
            $table->boolean('approved')->default(0);
            $table->boolean('is_main')->default(0);
            $table->unsignedTinyInteger('type')->default(0)->comment('0-normal,1-logo');
            $table->string('orientation')->comment('landscape or portrait')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_photos');
    }
}
