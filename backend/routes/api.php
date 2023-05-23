<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\MovieController;
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


Route::middleware('auth:sanctum')->post('auth/logout', [AuthApiController::class, 'logout'])->name('api.logout');
Route::post('/auth/login', [AuthApiController::class, 'authenticate'])->name('api.login');
Route::post('/auth/register', [AuthApiController::class, 'register']);

//movies
Route::get('/get/movies', [MovieController::class, 'index']);
Route::get('/get/movie/detail/{slug}', [MovieController::class, 'detail']);
