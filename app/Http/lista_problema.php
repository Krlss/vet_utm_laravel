<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lista_problema extends Model
{
    protected $table='lista_problemas';
    protected $fillable = ['id','id_maestra','nom_problema'];


    public static function problemas($id)
    {
        return lista_problema::where('id_maestra','=',$id)->get();
    }
}
