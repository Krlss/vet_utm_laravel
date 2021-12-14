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
            $table->string('pet_id', 15)->unique();
            $table->string('pet_photo_path', 2048)->nullable();
            $table->string('name');
            $table->date('birth'); 
            $table->string('sex')->default(null)->nullable();
            $table->string('specie');
            $table->boolean('castrated')->default(false);
            $table->string('race');
            $table->boolean('lost')->default(false);
            $table->integer('n_lost');
            $table->boolean('published')->default(false);
            $table->string('id_pet_pather', 15)->nullable();
            $table->string('id_pet_mother', 15)->nullable();
            $table->string('user_id', 13)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
