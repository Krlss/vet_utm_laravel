<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_canton',
    ];

    static $rules = [
        'name' => 'required|string|max:255',
        'id_canton' => 'required|integer|exists:cantons,id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_parsh');
    }

    public function canton()
    {
        return $this->belongsTo(Canton::class, 'id_canton');
    }
}
