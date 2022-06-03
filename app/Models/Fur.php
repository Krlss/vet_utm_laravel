<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Fur extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];

    public static $rules = [
        'name' => 'required'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class, 'id_fur');
    }

    public function species()
    {
        return $this->belongsToMany(Specie::class, 'species_furs', 'furs_id', 'species_id')->withPivot('furs_id', 'species_id');
    }
}
