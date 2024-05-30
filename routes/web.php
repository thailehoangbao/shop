<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\MainController as ClientMainController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\Users\ClientLoginController;
use App\Http\Controllers\Client\Users\ClientRegisterController;
use App\Http\Controllers\Client\Users\LogoutController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('users/login', [LoginController::class, 'index'])->name('login');
    Route::post('users/login/store', [LoginController::class, 'store']);
    Route::get('users/register', [RegisterController::class, 'index'])->name('register');
    Route::post('users/register/store', [RegisterController::class, 'store']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});



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

        #orders
        Route::prefix('orders')->group(function () {
            // Route::get('add', [AdminOrderController::class, 'create'])->name('orders.add');
            // Route::post('add', [AdminOrderController::class, 'store']);
            Route::get('list', [AdminOrderController::class, 'index'])->name('orders.list');

            Route::delete('destroy', [AdminOrderController::class, 'destroy']);

            Route::get('edit/{order}', [AdminOrderController::class, 'show'])->name('orders.edit');
            Route::post('edit/{order}', [AdminOrderController::class, 'update']);
        });
    });
});




Route::prefix('/')->group(function () {
    Route::get('/', [ClientMainController::class, 'index'])->name('home');
    Route::prefix('client')->group(function () {
        Route::get('login', [ClientLoginController::class, 'index'])->name('client.login');
        Route::post('login', [ClientLoginController::class, 'store'])->name('client.login.store');

        Route::get('register', [ClientRegisterController::class, 'index']);
        Route::post('register', [ClientRegisterController::class, 'store'])->name('client.register.store');

        Route::post('logout', [ClientLoginController::class, 'logout'])->name('client.logout');
    });

    Route::get('category/{menu}', [CategoryController::class, 'index']);
    Route::get('parentCategory/{menu}', [CategoryController::class, 'parentCategory']);

    Route::middleware(['auth'])->group(function () {
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    });
});



// <!-- {!! App\Helpers\Helper::menu($menus) !!} -->
