<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CinemaController;


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
    return view('welcome');
});


// login routes
Route::prefix('admin')->group(function () {
    Route::get("/login", [AuthController::class, 'getLogin'])->name('login');
    Route::post("/login", [AuthController::class, 'checkLogin'])->name('checkLogin');
    Route::get("/logout", [AuthController::class, 'Logout'])->name('logout');
});
//admin routes
Route::middleware('checkAdmin')->prefix('admin')->group(function () {
    Route::get("/index", [UserController::class, 'index'])->name('admin.index');
    Route::prefix('users')->group(function () {
        Route::get("/index", [UserController::class, 'show'])->name('users.show');
        Route::post("/index", [UserController::class, 'search'])->name('users.search');
        Route::get("/create", [UserController::class, 'create'])->name('users.create');
        Route::post("/create", [UserController::class, 'store'])->name('user.post');
        Route::get("/delete/{id}", [UserController::class, 'delete']);
        Route::get("/edit/{id}", [UserController::class, 'edit']);
        Route::put("/update", [UserController::class, 'update'])->name('user.update');
        Route::get("/permise", [UserController::class, 'permise'])->name('users.permise');
        Route::middleware('checkAdminPermission')->get("/permise1", [UserController::class, 'permise_admin'])->name('users.permise1');
    });

    Route::prefix('category')->group(function () {
        Route::get("/index", [CategoryController::class, 'index'])->name('admin.category');
        Route::get("/create", [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post("/store", [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get("/edit/{id}", [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put("/update/{id}", [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get("/delete/{id}", [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });

    Route::prefix('director')->group(function () {
        Route::get("/index", [DirectorController::class, 'index'])->name('admin.director');
        Route::get("/create", [DirectorController::class, 'create'])->name('admin.director.create');
        Route::post("/store", [DirectorController::class, 'store'])->name('admin.director.store');
        Route::get("/edit/{id}", [DirectorController::class, 'edit'])->name('admin.director.edit');
        Route::put("/update/{id}", [DirectorController::class, 'update'])->name('admin.director.update');
        Route::get("/delete/{id}", [DirectorController::class, 'destroy'])->name('admin.director.destroy');
    });

    Route::prefix('actor')->group(function () {
        Route::get("/index", [ActorController::class, 'index'])->name('admin.actor');
        Route::get("/create", [ActorController::class, 'create'])->name('admin.actor.create');
        Route::post("/store", [ActorController::class, 'store'])->name('admin.actor.store');
        Route::get("/edit/{id}", [ActorController::class, 'edit'])->name('admin.actor.edit');
        Route::put("/update/{id}", [ActorController::class, 'update'])->name('admin.actor.update');
        Route::get("/delete/{id}", [ActorController::class, 'destroy'])->name('admin.actor.destroy');
    });


    Route::prefix('area')->group(function () {
        Route::get('/', [AreaController::class, 'index'])->name('admin.area');
        Route::get('/create', [AreaController::class, 'create'])->name('admin.area.create');
        Route::post('/store', [AreaController::class, 'store'])->name('admin.area.store');
        Route::get('/edit/{id}', [AreaController::class, 'edit'])->name('admin.area.edit');
        Route::put('/update/{id}', [AreaController::class, 'update'])->name('admin.area.update');
        Route::get('/delete/{id}', [AreaController::class, 'delete'])->name('admin.area.delete');
    });
    Route::prefix('cinema')->group(function () {
        Route::get('/', [CinemaController::class, 'index'])->name('admin.cinema');
        Route::get('/create', [CinemaController::class, 'create'])->name('admin.cinema.create');
        Route::post('/store', [CinemaController::class, 'store'])->name('admin.cinema.store');
        Route::get('/edit/{id}', [CinemaController::class, 'edit'])->name('admin.cinema.edit');
        Route::put('/update/{id}', [CinemaController::class, 'update'])->name('admin.cinema.update');
        Route::get('/delete/{id}', [CinemaController::class, 'delete'])->name('admin.cinema.delete');
    });
});
