<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojaClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoja_clinicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_mascota');
            $table->string('ci_cliente');
            $table->string('fecha_consulta');
            $table->string('alimentacion');
            $table->string('habitad');
            $table->string('sombra');
            $table->string('concreto');
            $table->string('otro_animal');
            $table->string('otro_especie');
            $table->string('otro_cantidad');
            $table->string('salir');
            $table->string('paseos');
            $table->string('frec_paseos');
            $table->string('nom_desparasitante');
            $table->string('tipo_desparasitante');
            $table->string('fecha_desparasitante');
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
        Schema::dropIfExists('hoja_clinicas');
    }
}
