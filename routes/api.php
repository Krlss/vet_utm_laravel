<?php

use App\Http\Controllers\Api\ParishApiController;
use App\Http\Controllers\Api\PetApiController;
use App\Http\Controllers\Api\ProvinceApiController;
use App\Http\Controllers\Api\UserApiController;
use Google\Service\Storage;
use Google\Service\Docs\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


/* Route::get('getImage', function(){
    $files = Storage::disk("google")->allFiles();
    $firstFileName = $files[0];
    $details = Storage::disk('google')->getMetadata($firstFileName);
    dump($details);
    $url = Storage::disk('google')->url($firstFileName);
    dump($url);
}); */
 


Route::get('petsLost', [PetApiController::class, 'getAllPetsLost']);
Route::get('getPetByID/{id}', [PetApiController::class, 'getPetByID']);

Route::post('upload/petUnknown', [PetApiController::class, 'uploadPetUnknow'])->name('dashboard.uploadGoogle');
Route::post('reportPet', [PetApiController::class, 'reportPet']);

Route::post('login', [UserApiController::class, 'Login']);
Route::post('register', [UserApiController::class, 'Register']);
Route::get('users/{id}', [UserApiController::class, 'getProfile']);
Route::put('updatedUser/', [UserApiController::class, 'updateDataUser']);
Route::put('updatedPassword/', [UserApiController::class, 'updatedPassword']);
Route::put('updatedPet/', [PetApiController::class, 'updateDataPet']);  
Route::post('createdPet', [PetApiController::class, 'store']); 

Route::get('verifyEmail/{token}', [UserApiController::class, 'VerifyEmail']); 

Route::get('provinces', [ProvinceApiController::class, 'getAllProvinces']);
Route::get('provinces/cantons/{id}', [ProvinceApiController::class, 'getCantonsByProvince']);
Route::get('cantons/parish/{id}', [ParishApiController::class, 'getParishesByCanton']);
