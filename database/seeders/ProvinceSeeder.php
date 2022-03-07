<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Province::create(['name' => 'Azuay', 'letter' => 'A']);
        Province::create(['name' => 'Bolivar', 'letter' => 'B']);
        Province::create(['name' => 'Cañar', 'letter' => 'U']);
        Province::create(['name' => 'Carchi', 'letter' => 'C']);
        Province::create(['name' => 'Cotopaxi', 'letter' => 'X']);
        Province::create(['name' => 'Chimborazo', 'letter' => 'H']);
        Province::create(['name' => 'El Oro', 'letter' => 'O']);
        Province::create(['name' => 'Esmeraldas', 'letter' => 'E']);
        Province::create(['name' => 'Guayas', 'letter' => 'G']);
        Province::create(['name' => 'Imbabura', 'letter' => 'I']);
        Province::create(['name' => 'Loja', 'letter' => 'L']);
        Province::create(['name' => 'Los Rios', 'letter' => 'R']);
        Province::create(['name' => 'Manabi', 'letter' => 'M']);
        Province::create(['name' => 'Morona Santiago', 'letter' => 'V']);
        Province::create(['name' => 'Napo', 'letter' => 'N']);
        Province::create(['name' => 'Pastaza', 'letter' => 'S']);
        Province::create(['name' => 'Pichincha', 'letter' => 'P']);
        Province::create(['name' => 'Tungurahua', 'letter' => 'T']);
        Province::create(['name' => 'Zamora Chinchipe', 'letter' => 'Z']);
        Province::create(['name' => 'Galapagos', 'letter' => 'W']);
        Province::create(['name' => 'Sucumbios', 'letter' => 'K']);
        Province::create(['name' => 'Orellana', 'letter' => 'Q']);
        Province::create(['name' => 'Santo Domingo De Los Tsachilas', 'letter' =>    'J']);
        Province::create(['name' => 'Santa Elena', 'letter' => 'Y']);
    }
}
