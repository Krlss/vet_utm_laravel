<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaMaestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_maestras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod_mascota');
            $table->string('fecha_consulta');
            $table->string('sistema');
            $table->string('problema');
            $table->string('diagnostico_diferencial');
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
        Schema::dropIfExists('lista_maestras');
    }
}
