<?php

namespace Database\Seeders;

use App\Models\Canton;
use App\Models\Parish;
use App\Models\Province;
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

        $id_parish = Parish::all()->random()->id;
        $parish = Parish::where('id', $id_parish)->first();
        $id_canton = Canton::where('id', $parish->id_canton)->first();
        $id_province = Province::where('id', $id_canton->id_province)->first();

        User::create([
            'user_id' => '0000000000',
            'name' => 'root',
            'last_name1' => 'Apellido1',
            'last_name2' => 'Apellido2',
            'email' =>  'root@root.com',
            'id_parish' =>  $id_parish,
            'id_canton' => $id_canton->id,
            'id_province' => $id_province->id,
            'phone' =>  '0990146541',
            'password' =>  Hash::make('12345678'),
            'api_token' =>  Str::random(25),
        ])->assignRole('Administrador');
    }
}
