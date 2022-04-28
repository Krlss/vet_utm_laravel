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
        'specie',
        'race',
        'lost',
        'n_lost',
        'pet_id',
        'published',
        'castrated',
        'id_pet_pather',
        'id_pet_mother',
        'user_id',
    ];

    public static $rules = [
        'pet_id' => 'required|max:8|min:7',
        'name' => 'required',
        'specie' => 'required',
        'sex' => 'required',
        'race' => 'required',
        'birth' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function childrenPetPather()
    {
        return $this->hasMany(Pet::class, 'pet_id', 'pet_pather_id');
    }

    public function allChildrenPetPather()
    {
        return $this->childrenPetPather()->with('allChildrenPetPather');
    }

    public function childrenPetMother()
    {
        return $this->hasMany(Pet::class, 'pet_id', 'pet_mother_id');
    }

    public function allChildrenPetMother()
    {
        return $this->childrenPetMother()->with('allChildrenPetMother');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' - ' . $this->pet_id;
    }
}
