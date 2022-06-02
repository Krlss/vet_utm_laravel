<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpeciesFurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species_furs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('species_id');
            $table->unsignedInteger('furs_id');
            $table->timestamps();

            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('furs_id')->references('id')->on('furs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
