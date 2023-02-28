<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sistemas extends Model
{
    protected $table='sistemas';
    protected $fillable = ['id','nom_sistema'];
}
