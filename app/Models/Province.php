<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public function cantons()
    {
        return $this->hasMany(Canton::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_province');
    }
}
