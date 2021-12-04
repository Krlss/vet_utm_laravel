<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->string('pet_id', 14)->unique();
            $table->string('pet_photo_path', 2048)->nullable();
            $table->string('name');
            $table->string('birth')->nullable(); 
            $table->string('sex');
            $table->string('specie');
            $table->string('race');
            $table->boolean('lost')->default(false);
            $table->string('id_pet_pather', 14)->nullable();
            $table->string('id_pet_mother', 14)->nullable();
            $table->string('user_id', 13)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
