<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\WeatherApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Api Auth routes
Route::post('register', [AuthApiController::class, 'Register']);
Route::post('login', [AuthApiController::class, 'login']);
Route::post('logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');


//Api Event routes
Route::apiResource('events', EventApiController::class)->middleware('auth:sanctum');

//Weather routes
Route::get('weather/current/coords', [WeatherApiController::class, 'currentByCoords']);
Route::get('weather/current/city', [WeatherApiController::class, 'currentWeatherByCity']);
