<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role2 = Role::create(['name' => 'Cliente']);
        $role1 = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'dashboard.home'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.users.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.users.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'dashboard.pets.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.pets.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.pets.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.pets.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.pets.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'dashboard.reports.index'])->syncRoles([$role1]); 
        Permission::create(['name' => 'dashboard.reports.show'])->syncRoles([$role1]); 
        Permission::create(['name' => 'dashboard.reports.edit'])->syncRoles([$role1]); 

        Permission::create(['name' => 'dashboard.destroyImageGoogle'])->syncRoles([$role1]);

        Permission::create(['name' => 'dashboard.roles.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.roles.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.roles.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'dashboard.roles.destroy'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'dashboard.permissions'])->syncRoles([$role1]);
        

        
    }
}
