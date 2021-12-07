<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CantonController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\ProvinceController;

use Illuminate\Support\Facades\Route; 

Route::get('', [HomeController::class, 'index'])->name('dashboard.home');

Route::resource('users', UserController::class)->names('dashboard.users');
Route::resource('pets', PetController::class)->names('dashboard.pets'); 

Route::get('provinces/cantons', [ProvinceController::class, 'AllCantonsByProvince']); 

