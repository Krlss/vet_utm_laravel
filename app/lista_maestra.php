<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lista_maestra extends Model
{
    protected $fillable = ['diagnostico_diferencial','sistema','problema','fecha_consulta','cod_mascota'];
}
