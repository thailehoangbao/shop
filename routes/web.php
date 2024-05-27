<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\MainController as ClientMainController;
use Illuminate\Support\Facades\Route;




Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//kiểm tra vào link admin/users/main thì phải vượt qua dc middleware
Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('users/main', [UserController::class, 'index'])->name('admin');
        Route::get('main', [UserController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create'])->name('menus.add');
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index'])->name('menus.list');

            Route::delete('destroy', [MenuController::class, 'destroy']);

            Route::get('edit/{menu}', [MenuController::class, 'show'])->name('menus.edit');
            Route::post('edit/{menu}', [MenuController::class, 'update']);
        });

        #products
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create'])->name('products.add');
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index'])->name('products.list');

            Route::delete('destroy', [ProductController::class, 'destroy']);

            Route::get('edit/{product}', [ProductController::class, 'show'])->name('products.edit');
            Route::post('edit/{product}', [ProductController::class, 'update']);
        });

        #sliders
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create'])->name('sliders.add');
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index'])->name('sliders.list');

            Route::delete('destroy', [SliderController::class, 'destroy']);

            Route::get('edit/{slider}', [SliderController::class, 'show'])->name('sliders.edit');
            Route::post('edit/{slider}', [SliderController::class, 'update']);
        });
    });
});

Route::get('/', [ClientMainController::class, 'index']);

Route::get('category/{menu}', [CategoryController::class, 'index']);


// <!-- {!! App\Helpers\Helper::menu($menus) !!} -->
