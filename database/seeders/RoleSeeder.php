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
        $role1 = Role::create(['name' => 'Usuario']);
        $role3 = Role::create(['name' => 'Secretario']);
        $role2 = Role::create(['name' => 'Administrador']);


        Permission::create(['name' => 'dashboard.home'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.users.index'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.users.show'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.users.create'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.users.edit'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.users.destroy'])->syncRoles([$role2]);

        Permission::create(['name' => 'dashboard.pets.index'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.pets.create'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.pets.show'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.pets.edit'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.pets.destroy'])->syncRoles([$role2]);

        Permission::create(['name' => 'dashboard.reports.index'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.reports.show'])->syncRoles([$role3, $role2]);
        Permission::create(['name' => 'dashboard.reports.edit'])->syncRoles([$role3, $role2]);

        Permission::create(['name' => 'dashboard.destroyImageGoogle'])->syncRoles([$role3, $role2]);

        Permission::create(['name' => 'dashboard.users.role'])->syncRoles([$role2]);
        Permission::create(['name' => 'dashboard.roles.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'dashboard.roles.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'dashboard.roles.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'dashboard.roles.destroy'])->syncRoles([$role2]);

        Permission::create(['name' => 'dashboard.permissions'])->syncRoles([$role2]);
    }
}
