<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionApiController extends Controller
{
    public function store(Request $request)
    {

        /* $role = Role::where('name', 'Administrador')->get();

        Permission::create(['name' => 'dashboard.provinces.index'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.provinces.show'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.provinces.create'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.provinces.edit'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.provinces.destroy'])->syncRoles($role);

        Permission::create(['name' => 'dashboard.cantons.index'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.cantons.show'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.cantons.create'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.cantons.edit'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.cantons.destroy'])->syncRoles($role);

        Permission::create(['name' => 'dashboard.parishs.index'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.parishs.show'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.parishs.create'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.parishs.edit'])->syncRoles($role);
        Permission::create(['name' => 'dashboard.parishs.destroy'])->syncRoles($role); */
    }

    public function getToken(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['token' => $token]);
    }
}
