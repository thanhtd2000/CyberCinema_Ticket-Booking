<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\admin\FilmController;
use app\Http\Controllers\admin\AreasController;
use app\Http\Controllers\admin\CinemaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::prefix('admin')->group(function () {
    Route::prefix('film')->group(function () {
        Route::get('index',[FilmController::class,'index']);
        Route::post('add',[FilmController::class,'add']);
        Route::delete('delete/{id}',[FilmController::class,'delete']);
        Route::put('update/{id}',[FilmController::class,'update']);
        Route::get('edit',[FilmController::class,'edit']);
    });
    Route::prefix('Areas')->group(function () {
        Route::get('index',[AreasController::class,'index']);
        Route::post('add',[AreasController::class,'add']);
        Route::delete('delete/{id}',[AreasController::class,'delete']);
        Route::put('update/{id}',[AreasController::class,'update']);
        Route::get('edit',[AreasController::class,'edit']);
    });
    Route::prefix('cinema')->group(function() {
        Route::get('index',[CinemaController::class,'index']);
        Route::post('add',[CinemaController::class,'add']);
        Route::delete('delete/{id}',[CinemaController::class,'delete']);
        Route::get('edit/{id}',[CinemaController::class,'edit']);
        Route::put('update',[CinemaController::class,'update']);
    });
});