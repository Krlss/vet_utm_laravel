<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'last_name1',
        'last_name2',
        'email',
        'address',
        'password',
        'phone',
        'id_province',
        'id_canton',
    ];

    /**
     * 
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];
 

    public static $rules = [
        'user_id' => 'required|max:13|min:10',
        'name' => 'required',
        'last_name1' => 'required',
        'last_name2' => 'required',
        'email' => 'required',
        'id_canton' => 'required',
        'address' => 'required',
        'phone' => 'required|digits:10',
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function canton()
    {
        return $this->belongsTo(Canton::class);
    }
}
