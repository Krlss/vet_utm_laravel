<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_province'
    ];

    static $rules = [
        'name' => 'required|string|max:255',
        'id_province' => 'required|integer|exists:provinces,id'
    ];

    public function parishs()
    {
        return $this->hasMany(Parish::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_canton');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }
}
