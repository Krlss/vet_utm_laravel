<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CantonController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\ProvinceController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\PermissionController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('can:dashboard.home')->name('dashboard.home');

Route::post('pet/user', [UserController::class, 'getUserToPet']);
Route::delete('pet/user/delete', [PetController::class, 'deletePetToUser'])->name('dashboard.deletePetUser');
Route::delete('pet/children/delete', [PetController::class, 'deletePetToChildren'])->name('dashboard.deletePetChildren');

Route::resource('users', UserController::class)->names('dashboard.users');
Route::resource('pets', PetController::class)->names('dashboard.pets');

Route::get('provinces/cantons', [ProvinceController::class, 'AllCantonsByProvince']);

Route::post('parents', [PetController::class, 'getParents']);
Route::post('childrens', [PetController::class, 'getChildrens']);

Route::resource('reports', ReportController::class)->names('dashboard.reports');

Route::delete('destroyImgGoogle', [ReportController::class, 'destroyImageGoogle'])->name('dashboard.destroyImageGoogle');

Route::resource('roles', RolesController::class)->names('dashboard.roles');

Route::resource('permissions', PermissionController::class)->names('dashboard.permissions');

Route::post('permissions/revoke-permission-to-role', [PermissionController::class, 'revokePermissionToRole']);
Route::post('permissions/give-permission-to-role', [PermissionController::class, 'givePermissionToRole']);
