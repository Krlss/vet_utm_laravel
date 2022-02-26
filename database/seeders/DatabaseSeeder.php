<?php

namespace Database\Seeders;

use App\Models\Canton;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        /* Province::factory(100)->create(); */
        $this->call(ProvinceSeeder::class);
        //Canton::factory(500)->create();
        $this->call(CantonSeeder::class);
        //User::factory(150)->create();
        $this->call(UserSeeder::class);
    }
}
