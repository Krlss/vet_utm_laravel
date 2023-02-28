<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_mascotas', function (Blueprint $table) {
            $table->bigIncrements('pet_id');
            $table->string('pet_photo_path');
            $table->string('name');
            $table->string('birth');
            $table->string('sex');
            $table->string('specie');
            $table->string('castrated');
            $table->string('race');
            $table->string('lost');
            $table->string('n_lost');
            $table->string('published');
            $table->string('id_pet_pather');
            $table->string('id_pet_mother');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_mascotas');
    }
}
