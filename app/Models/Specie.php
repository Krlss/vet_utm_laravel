<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Specie extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];

    public static $rules = [
        'name' => 'required',
    ];

    public function races()
    {
        return $this->hasMany(Race::class, 'id_specie', 'id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'id_specie', 'id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'external_id');
    }
}
