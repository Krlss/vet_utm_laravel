<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Specie::create(['name' => 'Canino']); //1
        Specie::create(['name' => 'Felino']); //2
        Specie::create(['name' => 'Hámster']); //3
        Specie::create(['name' => 'Pájaro']); //4
    }
}
