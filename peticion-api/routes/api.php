<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/superhero/{id}', [SuperheroController::class, 'getSuperhero']);
Route::get('/superhero/search/{name}', [SuperheroController::class, 'searchSuperhero']);
Route::post('/superhero', [SuperheroController::class, 'createSuperhero']);
Route::put('/superhero/{id}', [SuperheroController::class, 'updateSuperhero']);

Route::get('/geolocation/ip/{ip}', [GeolocationController::class, 'getGeolocationByIP']);
Route::get('/geolocation/country/{code}', [GeolocationController::class, 'getGeolocationByCountry']);
Route::post('/geolocation', [GeolocationController::class, 'createGeolocation']);
Route::put('/geolocation/{id}', [GeolocationController::class, 'updateGeolocation']);



/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

