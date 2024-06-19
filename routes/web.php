<?php

use App\Http\Controllers\Admin\Blog\CategoryPostController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Client\About\AboutController;
use App\Http\Controllers\Client\Blog\BlogController as ClientBlogController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\Contact\ContactController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\MainController as ClientMainController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\Profile\ProfileController;
use App\Http\Controllers\Client\Search\SearchController;
use App\Http\Controllers\Client\Users\ClientLoginController;
use App\Http\Controllers\Client\Users\ClientRegisterController;
use App\Http\Controllers\Client\Users\FacebookController;
use App\Http\Controllers\Client\Users\GoogleController;
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
            Route::get('list', [AdminOrderController::class, 'index'])->name('orders.list');

            Route::delete('destroy', [AdminOrderController::class, 'destroy']);

            Route::get('edit/{order}', [AdminOrderController::class, 'show'])->name('orders.edit');
            Route::post('edit/{order}', [AdminOrderController::class, 'update']);
        });

        #payment
        Route::prefix('payments')->group(function () {
            Route::get('list', [AdminPaymentController::class, 'index'])->name('payment.list');
            Route::get('detail', [AdminPaymentController::class, 'detail']);
            Route::delete('destroy', [AdminPaymentController::class, 'destroy']);

            Route::get('edit/{payment}', [AdminPaymentController::class, 'show'])->name('payment.edit');
            Route::post('edit/{payment}', [AdminPaymentController::class, 'update']);
            Route::get('notification/{payment}', [AdminPaymentController::class, 'notification']);
        });

        #blog
        Route::prefix('blog')->group(function () {
            Route::prefix('category')->group(function () {
                Route::get('add', [CategoryPostController::class, 'index'])->name('blog.category.add');
                Route::post('add', [CategoryPostController::class, 'store']);
                Route::get('list', [CategoryPostController::class, 'list'])->name('blog.category.list');

                Route::delete('destroy', [CategoryPostController::class, 'destroy']);

                Route::get('edit/{category}', [CategoryPostController::class, 'edit'])->name('blog.category.edit');
                Route::post('edit/{category}', [CategoryPostController::class, 'update']);
            });

            #post
            Route::prefix('post')->group(function () {
                Route::get('add', [PostController::class, 'index'])->name('blog.post.add');
                Route::post('add', [PostController::class, 'store']);
                Route::get('list', [PostController::class, 'list'])->name('blog.post.list');

                Route::delete('destroy', [PostController::class, 'destroy']);

                Route::get('edit/{post}', [PostController::class, 'edit'])->name('blog.post.edit');
                Route::post('edit/{post}', [PostController::class, 'update']);
            });
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

        Route::prefix('google')->group(function () {
            Route::get('', [GoogleController::class, 'redirectToGoogle']);
            Route::get('callback', [GoogleController::class, 'handleGoogleCallback']);
        });

        Route::prefix('facebook')->group(function(){
            Route::get('',[FacebookController::class ,'redirectToFacebook'])->name('auth.facebook');
            Route::get('callback',[FacebookController::class, 'handleFacebookCallback']);
        });

        Route::post('feedback', [ClientMainController::class, 'feedback'])->name('client.feedback');
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

        Route::get('my-account', [ClientMainController::class, 'myAccount']);
    });

    Route::prefix('profile')->group(function () {
        Route::get('info', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('info', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('destroy-payment', [ProfileController::class, 'destroy']);
        Route::get('show-detail', [ProfileController::class, 'showDetail']);
    });

    Route::prefix('blog')->group(function () {
        Route::get('info', [ClientBlogController::class, 'index'])->name('blog.index');
        Route::get('post', [ClientBlogController::class, 'post'])->name('blog.post');
        Route::post('post', [ClientBlogController::class, 'userCreatePost']);
        Route::get('post/{post}', [ClientBlogController::class, 'postDetail']);
        Route::get('contact', [ClientBlogController::class, 'contact'])->name('blog.contact');
        Route::prefix('search')->group(function () {
            Route::post('post', [ClientBlogController::class, 'searchPost'])->name('blog.search');
        });

        Route::get('comment', [ClientBlogController::class, 'comment'])->name('blog.comment');
    });

    Route::prefix('search')->group(function () {
        Route::post('product', [SearchController::class, 'searchProduct'])->name('search.product');
    });

    Route::prefix('about')->group(function () {
        Route::get('info', [AboutController::class, 'index']);
    });

    Route::prefix('contact')->group(function () {
        Route::get('info', [ContactController::class, 'index']);
    });
});
