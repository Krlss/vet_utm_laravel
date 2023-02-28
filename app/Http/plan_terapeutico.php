<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plan_terapeutico extends Model
{
    protected $fillable = ['tipo_terapia','principio_activo','presentacion','medicamento','dosis_cant','dosis_tiempo','dosis_administra','via','frec_duracion','cant_medicamento','fecha_consulta','cod_mascota'];
}
