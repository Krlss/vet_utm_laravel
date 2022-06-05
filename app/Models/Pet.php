<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pet extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $keyType = 'string';
    protected $primaryKey = 'pet_id';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'birth',
        'sex',
        'lost',
        'n_lost',
        'pet_id',
        'characteristic',
        'published',
        'castrated',
        'id_specie',
        'id_race',
        'id_fur',
        'id_pet_pather',
        'id_pet_mother',
        'user_id',
    ];

    public static $rules = [
        'pet_id' => 'required|max:8|min:7',
        'name' => 'required',
        'id_specie' => 'required',
        'id_race' => 'required',
        'sex' => 'required',
        'birth' => 'required'
    ];

    public static $rulesCreate = [
        'name' => 'required',
        'id_specie' => 'required',
        'id_race' => 'required',
        'sex' => 'required',
        'birth' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'external_id');
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' - ' . $this->pet_id;
    }

    public function specie()
    {
        return $this->belongsTo(Specie::class, 'id_specie');
    }

    public function race()
    {
        return $this->belongsTo(Race::class, 'id_race');
    }

    public function fur()
    {
        return $this->belongsTo(Fur::class, 'id_fur');
    }
}
