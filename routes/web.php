<?php

use Illuminate\Support\Facades\Route;

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
        Route::get('index',function(){
            return view('admin.film.index');
        });
        Route::post('add',function(){
            return view('admin.film.AddFilm');
        });
        Route::delete('delete/{id}',function(){
            return view('ShowFilm');
        });
        
        Route::put('update/{id}',function(){
            return view('Updatefilm');
        });
        Route::get('edit',function(){
            return view('ShowFilm');
        });
    });
    Route::prefix('Areas')->group(function () {
        Route::get('index',function(){
            return view('admin.area.ShowAreas');
        });
        Route::post('add',function(){
            return view('admin.area.AddArea');
        });
        Route::delete('delete/{id}',function(){
            return view('admin.area.ShowAreas');
        });
        
        Route::put('update/{id}',function(){
            return view('admin.area.UpdateArea');
        });
        Route::get('edit',function(){
            return view('admin.area.ShowAreas');
        });
    });
    Route::prefix('cinema')->group(function() {
        Route::get('index',function(){
            return view('admin.cinema.index');
        });
        Route::post('add',function(){
            return view('admin.cinema.add');
        });
        Route::delete('delete/{id}',function(){
            return view('admin.cinema.index');
        });
        Route::get('edit/{id}',function(){
            return view('admin.cinema.edit');
        });
        Route::put('update',function(){
            return view('admin.cinema.index');
        });
    });
});