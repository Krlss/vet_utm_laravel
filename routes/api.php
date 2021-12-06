<?php

use App\Http\Controllers\Api\PetApiController;
use App\Http\Controllers\Api\UserApiController;
use Google\Service\Storage;
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

/* Route::post('upload/petUnknown', function(Request $request){
    dd($request->file("thing")->store("", "google"));
})->name('dashboard.upload');

Route::get('getImage', function(){
    $files = Storage::disk("google")->allFiles();
    $firstFileName = $files[0];
    $details = Storage::disk('google')->getMetadata($firstFileName);
    dump($details);
    $url = Storage::disk('google')->url($firstFileName);
    dump($url);
});
 */

Route::post('login', [UserApiController::class, 'Login']);

Route::get('petsLost', [PetApiController::class, 'getAllPetsLost']);
Route::get('getPetByID/{id}', [PetApiController::class, 'getPetByID']);

Route::post('upload/petUnknown', [PetApiController::class, 'uploadPetUnknow']);
