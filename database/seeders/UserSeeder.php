<?php

namespace Database\Seeders;

use App\Models\Canton;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_id' => '0000000000',
            'name' => 'root',
            'last_name1' => 'Apellido1',
            'last_name2' => 'Apellido2',
            'email' =>  'root@root.com',
            'id_canton' =>  Canton::all()->random()->id,
            'address' =>  'aisdjasoidjaosid',
            'phone' =>  '0990146541',
            'password' =>  Hash::make('12345678'),
            'api_token' =>  Str::random(25),
        ])->assignRole('Administrador');
    }
}
