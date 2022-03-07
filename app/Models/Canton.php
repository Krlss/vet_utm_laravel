<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;

    public function parishs()
    {
        return $this->hasMany(Parish::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
