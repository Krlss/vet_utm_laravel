<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenFisicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_fisicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_mascota');
            $table->string('fecha_consulta');
            $table->string('peso');
            $table->string('temperatura');
            $table->string('frec_respiratoria');
            $table->string('frec_cardiaca');
            $table->string('tllc');
            $table->string('deshidratacion');
            $table->string('porciento_deshidratacion');
            $table->string('mucosas');
            $table->string('otros');
            $table->string('lm');
            $table->string('lm_comentario');
            $table->string('le');
            $table->string('le_comentario');
            $table->string('li');
            $table->string('li_comentario');
            $table->string('lp');
            $table->string('lp_comentario');
            $table->string('patron_distribucion');
            $table->string('comentario_patron');
            $table->string('g1');
            $table->string('g1_comentario');
            $table->string('g2');
            $table->string('g2_comentario');
            $table->string('g3');
            $table->string('g3_comentario');
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
        Schema::dropIfExists('examen_fisicos');
    }
}
