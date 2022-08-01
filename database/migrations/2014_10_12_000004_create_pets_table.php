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
            $table->date('birth')->nullable();
            $table->string('sex')->default(null)->nullable();
            $table->boolean('castrated')->default(false);
            $table->boolean('lost')->default(false);
            $table->integer('n_lost');
            $table->boolean('published')->default(true);
            $table->string('id_pet_pather', 15)->nullable();
            $table->string('id_pet_mother', 15)->nullable();
            $table->integer('id_specie')->nullable()->unsigned();
            $table->integer('id_race')->nullable()->unsigned();
            $table->integer('id_fur')->nullable()->unsigned();
            $table->string('user_id', 13)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_fur')->references('id')->on('furs')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_specie')->references('id')->on('species')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_race')->references('id')->on('races')->onDelete('set null')->onUpdate('cascade');
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
