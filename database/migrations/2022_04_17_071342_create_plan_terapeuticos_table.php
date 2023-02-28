<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTerapeuticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_terapeuticos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_mascota');
            $table->string('fecha_consulta');
            $table->string('tipo_terapia');
            $table->string('principio_activo');
            $table->string('presentacion');
            $table->string('dosis_cant');
            $table->string('dosis_tiempo');
            $table->string('dosis_administra');
            $table->string('via');
            $table->string('frec_duracion');
            $table->string('cant_medicamento');
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
        Schema::dropIfExists('plan_terapeuticos');
    }
}
