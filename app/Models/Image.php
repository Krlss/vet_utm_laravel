<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Habilitar asignacion masiva
    protected $fillable = ['id_image', 'external_id', 'url', 'name'];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'external_id');
    }

    public function specie()
    {
        return $this->belongsTo(Specie::class, 'external_id');
    }
}
