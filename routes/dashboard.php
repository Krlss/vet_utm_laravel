<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CantonController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\ProvinceController;
use App\Http\Controllers\admin\ParishController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\Audit;
use App\Http\Controllers\admin\FurController;
use App\Http\Controllers\admin\RaceController;
use App\Http\Controllers\admin\SpecieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('can:dashboard.home')->name('dashboard.home');

Route::post('pet/user', [UserController::class, 'getUserToPet']);
Route::delete('pet/user/delete', [PetController::class, 'deletePetToUser'])->name('dashboard.deletePetUser');
Route::delete('pet/children/delete', [PetController::class, 'deletePetToChildren'])->name('dashboard.deletePetChildren');

Route::resource('users', UserController::class)->names('dashboard.users');
Route::resource('pets', PetController::class)->names('dashboard.pets');

Route::resource('species', SpecieController::class, ['except' => ['show']])->names('dashboard.species');
Route::resource('races', RaceController::class, ['except' => ['show']])->names('dashboard.races');
Route::post('getFurs', [FurController::class, 'getFursToAjax']);
Route::resource('furs', FurController::class, ['except' => ['show']])->names('dashboard.furs');

Route::get('getRacesToSpeciesAjax', [SpecieController::class, 'getRacesToSpeciesAjax']);

Route::get('getFursToSpeciesAjax', [SpecieController::class, 'getFursToSpeciesAjax']);

Route::get('provinces/cantons', [ProvinceController::class, 'AllCantonsByProvince']);
Route::get('provinces/cantons/parishes', [ProvinceController::class, 'AllParishesByCanton']);

Route::post('parents', [PetController::class, 'getParents']);
Route::post('childrens', [PetController::class, 'getChildrens']);
Route::post('PetsWithoutOwner', [PetController::class, 'getPetsWithoutOwner']);
Route::post('pet/childrens', [PetController::class, 'getChildrensToPet']);

Route::resource('reports', ReportController::class)->names('dashboard.reports');

Route::delete('destroyImgGoogle', [ReportController::class, 'destroyImageGoogle'])->name('dashboard.destroyImageGoogle');

Route::resource('roles', RolesController::class)->names('dashboard.roles');

Route::resource('permissions', PermissionController::class)->names('dashboard.permissions');

Route::resource('audit', Audit::class)->names('dashboard.audit');

Route::post('permissions/revoke-permission-to-role', [PermissionController::class, 'revokePermissionToRole']);
Route::post('permissions/give-permission-to-role', [PermissionController::class, 'givePermissionToRole']);


Route::post('add-fur-modal', [FurController::class, 'addFurModal']);
Route::post('add-specie-modal', [SpecieController::class, 'addSpecieModal']);
Route::post('add-race-modal', [RaceController::class, 'addRaceModal']);

Route::post('add-canton-modal', [CantonController::class, 'addCantonModal']);
Route::post('add-province-modal', [ProvinceController::class, 'addProvinceModal']);
Route::post('add-parish-modal', [ParishController::class, 'addParishModal']);

Route::post('add-role-modal', [RolesController::class, 'addRoleModal']);

Route::resource('provinces', ProvinceController::class)->names('dashboard.provinces');
Route::resource('cantons', CantonController::class)->names('dashboard.cantons');
Route::resource('parishs', ParishController::class)->names('dashboard.parishs');
