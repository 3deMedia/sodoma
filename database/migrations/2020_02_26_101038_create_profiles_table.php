<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('type_id');
            $table->foreign('type_id')->references('id')->on('profile_types');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('web')->nullable();
            $table->text('description');
            $table->boolean('approved')->default(0);
            $table->boolean('is_vip')->default(0)->comment('significa caro');
            $table->boolean('verified')->nullable()->default(0)->comment('es un perfil real');
            $table->boolean('top')->nullable()->default(0)->comment('debe aparecer en top');
            $table->boolean('active')->default(0);
            $table->boolean('can_be_reviewed')->default(0);
            $table->dateTime('monthly_agency_period')->nullable()->comment('las agencias deben pagar al mes para activar su perfil');
            $table->boolean('hide_face')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
