<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

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
        'name' => 'required',
        'specie' => 'required',
        'race' => 'required',
        'lost' => 'required',
        'birth' => 'required',
        'castrated' => 'required',
    ]; 

    public function user()
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
 
     public function images(){
        return $this->hasMany(Image::class);
    }
}
