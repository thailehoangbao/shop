<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\MainController as ClientMainController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\Users\ClientLoginController;
use App\Http\Controllers\Client\Users\ClientRegisterController;
use App\Http\Controllers\Client\Users\LogoutController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('email', [EmailController::class, 'sendEmail']);

Route::prefix('admin')->group(function () {
    Route::get('users/login', [LoginController::class, 'index'])->name('admin.login');
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
        Route::get('login', [ClientLoginController::class, 'index'])->name('login');
        Route::post('login', [ClientLoginController::class, 'store'])->name('client.login.store');

        Route::get('register', [ClientRegisterController::class, 'index']);
        Route::post('register', [ClientRegisterController::class, 'store'])->name('client.register.store');
        Route::get('forgot-password', [ClientLoginController::class, 'forgotPassword'])->name('forgot.password');
        Route::post('forgot-password', [ClientLoginController::class, 'sendEmailForgotPassword']);
        Route::get('reset-password/{id}/{token}', [ClientLoginController::class, 'resetPassword'])->name('reset.password');
        Route::post('reset-password/{id}/{token}', [ClientLoginController::class, 'updatePassword']);

        Route::post('logout', [ClientLoginController::class, 'logout'])->name('client.logout');
    });

    Route::get('category/{menu}', [CategoryController::class, 'index']);
    Route::get('parentCategory/{menu}', [CategoryController::class, 'parentCategory']);

    Route::get('except-order/{payment}/{token}', [EmailController::class, 'except'])->name('except.order');
    Route::get('confirm-register/{token}', [EmailController::class, 'confirmRegister'])->name('confirm.register');

    Route::middleware(['auth'])->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');
        Route::delete('orders/destroy', [OrderController::class, 'destroy']);

        Route::get('detail/{product}', [DetailController::class, 'store'])->name('product.detail');
        Route::post('detail/orders', [DetailController::class, 'order'])->name('product.detail.orders');

        Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
        Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    });
});



