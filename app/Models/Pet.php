<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function pet()
    {
        return $this->belongsTo(User::class);
    }

    public function childrenPetPather()
    {
        return $this->hasMany(Pet::class, 'pet_pather_id', 'pet_id');
    }

    public function allChildrenPetPather()
    {
        return $this->childrenPetPather()->with('allChildrenPetPather');
    }

    public function childrenPetMother()
    {
        return $this->hasMany(Pet::class, 'pet_mother_id', 'pet_id');
    }

    public function allChildrenPetMother()
    {
        return $this->childrenPetMother()->with('allChildrenPetMother');
    }
}
