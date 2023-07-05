<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SeatRowController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SeatTypeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\StatisticalsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// login routes
Route::prefix('admin')->group(function () {
    Route::get("/login", [AuthController::class, 'getLogin'])->name('login');
    Route::post("/login", [AuthController::class, 'checkLogin'])->name('checkLogin');
    Route::get("/logout", [AuthController::class, 'Logout'])->name('logout');
});
//admin routes
Route::middleware('checkAdmin')->prefix('admin')->group(function () {
    Route::get("/index", [StatisticalsController::class, 'index'])->name('admin.index');

    Route::prefix('users')->group(function () {
        Route::get("/index", [UserController::class, 'show'])->name('users.show')->middleware('can:list-user');
        Route::post("/index", [UserController::class, 'show'])->name('users.search')->middleware('can:list-user');
        Route::get("/create", [UserController::class, 'create'])->name('users.create')->middleware('can:create-user');
        Route::post("/create", [UserController::class, 'store'])->name('user.post');
        Route::get("/delete/{id}", [UserController::class, 'delete'])->middleware('can:delete-user');
        Route::get("/edit/{id}", [UserController::class, 'edit'])->middleware('can:edit-user');
        Route::put("/update", [UserController::class, 'update'])->name('user.update');
        Route::get("/permise", [UserController::class, 'permise'])->name('users.permise');
        Route::middleware('checkAdminPermission')->get("/permise1", [UserController::class, 'permise_admin'])->name('users.permise1');
        Route::get("/change-password", [UserController::class, 'viewchange'])->name('users.change_password');
        Route::put("/change-password", [UserController::class, 'change'])->name('users.change_passwords');
        //Permission
        Route::get("/permission", [PermissionController::class, 'index'])->name('permission.list')->middleware('can:permission');
        Route::get("/permission/create", [PermissionController::class, 'create'])->name('permission.create')->middleware('can:permission');
        Route::post("/permission/store", [PermissionController::class, 'store'])->name('permission.store')->middleware('can:permission');
        Route::get("/permission/edit/{id}", [PermissionController::class, 'edit'])->name('permission.edit')->middleware('can:permission');
        Route::put("/permission/update", [PermissionController::class, 'update'])->name('permission.update')->middleware('can:permission');
    });

    Route::prefix('category')->group(function () {
        Route::get("/index", [CategoryController::class, 'index'])->name('admin.category')->middleware('can:list-category');
        Route::get("/create", [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post("/store", [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get("/edit/{id}", [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put("/update/{id}", [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get("/delete/{id}", [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::post("/index", [CategoryController::class, 'search'])->name('admin.category.search');
    });

    Route::prefix('director')->group(function () {
        Route::get("/index", [DirectorController::class, 'index'])->name('admin.director')->middleware('can:list-director');
        Route::get("/create", [DirectorController::class, 'create'])->name('admin.director.create');
        Route::post("/store", [DirectorController::class, 'store'])->name('admin.director.store');
        Route::get("/edit/{id}", [DirectorController::class, 'edit'])->name('admin.director.edit');
        Route::put("/update/{id}", [DirectorController::class, 'update'])->name('admin.director.update');
        Route::get("/delete/{id}", [DirectorController::class, 'destroy'])->name('admin.director.destroy');
        Route::post("/index", [DirectorController::class, 'search'])->name('admin.director.search');
    });

    Route::prefix('actor')->group(function () {
        Route::get("/index", [ActorController::class, 'index'])->name('admin.actor')->middleware('can:list-actor');
        Route::get("/create", [ActorController::class, 'create'])->name('admin.actor.create');
        Route::post("/store", [ActorController::class, 'store'])->name('admin.actor.store');
        Route::get("/edit/{id}", [ActorController::class, 'edit'])->name('admin.actor.edit');
        Route::put("/update/{id}", [ActorController::class, 'update'])->name('admin.actor.update');
        Route::get("/delete/{id}", [ActorController::class, 'destroy'])->name('admin.actor.destroy');
        Route::post("/index", [ActorController::class, 'search'])->name('admin.actor.search');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product')->middleware('can:list-product');
        Route::post('/search', [ProductController::class, 'index'])->name('admin.product.search');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });

    Route::prefix('movie')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('admin.movie')->middleware('can:list-movie');
        Route::get('/create', [MovieController::class, 'create'])->name('admin.movie.create');
        Route::post('/store', [MovieController::class, 'store'])->name('admin.movie.store');
        Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('admin.movie.edit');
        Route::put('/update/{id}', [MovieController::class, 'update'])->name('admin.movie.update');
        Route::get('/delete/{id}', [MovieController::class, 'destroy'])->name('admin.movie.delete');
        Route::post("/index", [MovieController::class, 'index'])->name('admin.movie.search');
        Route::get("/trash", [MovieController::class, 'trash'])->name('admin.movie.trash');
        Route::get("/restore/{id}", [MovieController::class, 'restore'])->name('admin.movie.restore');
        Route::get("/show/{id}", [MovieController::class, 'show'])->name('admin.movie.show');
    });
    Route::prefix('seat_type')->group(function () {
        Route::get('/', [SeatTypeController::class, 'index'])->name('admin.seat_type')->middleware('can:list-seatType');
        Route::get('/create', [SeatTypeController::class, 'create'])->name('admin.seat_type.create');
        Route::post('/store', [SeatTypeController::class, 'store'])->name('admin.seat_type.store');
        Route::get('/edit/{id}', [SeatTypeController::class, 'edit'])->name('admin.seat_type.edit');
        Route::put('/update/{id}', [SeatTypeController::class, 'update'])->name('admin.seat_type.update');
        Route::get('/delete/{id}', [SeatTypeController::class, 'destroy'])->name('admin.seat_type.delete');
    });
    Route::prefix('seats')->group(function () {
        Route::get('/', [SeatController::class, 'index'])->name('admin.seat_row')->middleware('can:list-seat');
        Route::get('/create', [SeatController::class, 'create'])->name('admin.seat_row.create');
        Route::post('/store', [SeatController::class, 'store'])->name('admin.seat_row.store');
        Route::get('/edit/{id}', [SeatController::class, 'edit'])->name('admin.seat.edit')->middleware('can:edit-seat');
        Route::put('/update/{id}', [SeatController::class, 'update'])->name('admin.seat.update');
        Route::get('/delete/{id}', [SeatController::class, 'destroy'])->name('admin.seat_row.delete')->middleware('can:delete-seat');
    });
    Route::prefix('posts')->group(function () {
        Route::get("/index", [PostController::class, 'show'])->name('posts.show')->middleware('can:list-post');
        Route::get("/create", [PostController::class, 'create']);
        Route::post("/create", [PostController::class, 'store'])->name('post-create');
        Route::get("/delete/{id}", [PostController::class, 'delete'])->name('delete-post')->middleware('CheckIsAdmin');
        Route::get("/edit/{id}", [PostController::class, 'edit'])->name('posts.edit')->middleware('CheckIsAdmin');
        Route::put("/update", [PostController::class, 'update'])->name('posts.update');
        Route::get("/update-stt/{id}&&{status}", [PostController::class, 'updatestt'])->name('posts.updatestt');
        Route::post("/index", [PostController::class, 'search'])->name('posts.search');
        Route::delete("/deleteMultiple", [PostController::class, 'deleteMultiple'])->name('delete.Mulposts');
    });
    Route::prefix('room')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('admin.room')->middleware('can:list-room');;
        Route::get('/create', [RoomController::class, 'create'])->name('admin.room.create');
        Route::post('/store', [RoomController::class, 'store'])->name('admin.room.store');
        Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('admin.room.edit');
        Route::put('/update/{id}', [RoomController::class, 'update'])->name('admin.room.update');
        Route::get('/delete/{id}', [RoomController::class, 'destroy'])->name('admin.room.delete');
        Route::get("/trash", [RoomController::class, 'trash'])->name('admin.room.trash');
        Route::get("/restore/{id}", [RoomController::class, 'restore'])->name('admin.room.restore');
        Route::post('get/payment', [RoomController::class, 'createPayment'])->name('admin.room.createPayment');
    });
    Route::prefix('/schedule')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('admin.schedule')->middleware('can:list-schedule');
        Route::get('/create', [ScheduleController::class, 'create'])->name('admin.schedule.create');
        Route::post('/store', [ScheduleController::class, 'store'])->name('admin.schedule.store');
        Route::get('/edit/{id}', [ScheduleController::class, 'edit'])->name('admin.schedule.edit');
        Route::put('/update/{id}', [ScheduleController::class, 'update'])->name('admin.schedule.update');
        Route::get('delete/{id}', [ScheduleController::class, 'delete'])->name('admin.schedule.delete');
    });

    Route::prefix('/discount')->group(function () {
        Route::get('/', [DiscountController::class, 'index'])->name('admin.discount')->middleware('can:list-discount');
        Route::get('/search', [DiscountController::class, 'search'])->name('admin.discount.search');
        Route::get('/create', [DiscountController::class, 'create'])->name('admin.discount.create');
        Route::post('/store', [DiscountController::class, 'store'])->name('admin.discount.store');
        Route::get('/edit/{id}', [DiscountController::class, 'edit'])->name('admin.discount.edit');
        Route::put('/update/{id}', [DiscountController::class, 'update'])->name('admin.discount.update');
        Route::get('/delete/{id}', [DiscountController::class, 'delete'])->name('admin.discount.delete');
    });

    Route::prefix('/transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('admin.transaction');
    });
});