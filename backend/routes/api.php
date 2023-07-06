<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Postcontroller;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SeatController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DiscountController;
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
Route::get('/get/schedule/room', [ScheduleController::class, 'getRooms']);

//room
Route::middleware('auth:sanctum')->post('/get/room', [RoomController::class, 'getSeats']);

//users
Route::middleware('auth:sanctum')->post('/users/update-profile', [AuthApiController::class, 'update']);

Route::middleware('auth:sanctum')->patch('/update-status-seat', [SeatController::class, 'updateStatusSeat']);

Route::middleware('auth:sanctum')->get('/get/discount/detail ', [DiscountController::class, 'getDiscount']);
Route::middleware('auth:sanctum')->get('/get/discount/list', [DiscountController::class, 'getAllDiscount']);

//Products
Route::get('get/products', [ProductController::class, 'index']);

//Payment
Route::middleware('auth:sanctum')->post('get/payment', [PaymentController::class, 'createPayment']);
Route::get('/payment', [PaymentController::class, 'insertPayment'])->name('vnp_ReturnUrl');
