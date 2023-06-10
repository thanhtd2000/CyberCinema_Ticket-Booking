<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Postcontroller;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ScheduleController;

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


//posts
Route::get('/get/posts', [Postcontroller::class, 'index']);
Route::get('/get/post/detail/{slug}', [Postcontroller::class, 'detail']);

//schedule
Route::get('/get/schedule', [ScheduleController::class, 'getScheduleMovie']);

//room
Route::middleware('auth:sanctum')->get('/get/room', [RoomController::class, 'getSeats']);

//users
Route::middleware('auth:sanctum')->post('/users/update-profile', [AuthApiController::class, 'update']);
