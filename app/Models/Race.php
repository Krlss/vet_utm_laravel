<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Race extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name', 'id_specie'];

    public static $rules = [
        'name' => 'required',
        'id_specie' => 'required'
    ];

    public function specie()
    {
        return $this->belongsTo(Specie::class, 'id_specie');
    }

    public function pets()
    {
        return $this->belongsTo(Pet::class, 'id_specie');
    }
}
