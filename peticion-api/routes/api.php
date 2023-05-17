<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperheroController;
use App\Http\Controllers\GeolocationController;
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

Route::get('/superhero/{id}', [SuperheroController::class, 'getSuperheroById'])->name('getSuperheroById');;
Route::get('/superheroes/{id}/powerstats', [SuperheroController::class, 'getSuperheroPowerstatsById']);
Route::get('/superheroes/{id}/biography', [SuperheroController::class, 'getSuperheroBiographyById']);
Route::get('/superheroes/{id}/work', [SuperheroController::class, 'getSuperheroWorkById'])->name('superheroes.getWorkById');

Route::get('/geolocation', [GeolocationController::class, 'getGeolocation'])->name('geolocation.get');



/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

