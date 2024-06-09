<?php

namespace App\Providers;

use App\Http\View\Composers\AmountPaymentComposer;
use App\Http\View\Composers\AmountProductComposer;
use App\Http\View\Composers\CategoriesPostComposer;
use App\Http\View\Composers\CommentsComposer;
use App\Http\View\Composers\ListProductCartComposer;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\PaymentsComposer;
use App\Http\View\Composers\PostsComposer;
use App\Http\View\Composers\ProductComposer;
use App\Http\View\Composers\SliderComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        #Admin
        Facades\View::composer(['admin.navbar'],AmountPaymentComposer::class);
        Facades\View::composer(['admin.modal'],PaymentsComposer::class);


        Facades\View::composer(['client.header','client.banner','client.product'],MenuComposer::class);
        Facades\View::composer(['client.slider'],SliderComposer::class);
        Facades\View::composer(['client.product'],ProductComposer::class);
        Facades\View::composer('client.header',AmountProductComposer::class);
        Facades\View::composer(['client.cart','email.formemail','client.detail.cart','client.category.cart'],ListProductCartComposer::class);


        #Blog
        Facades\View::composer(['client.blog.index','client.blog.sidebarright'],PostsComposer::class);
        Facades\View::composer(['client.blog.comment','client.blog.index'],CommentsComposer::class);
        Facades\View::composer(['client.blog.sidebarright'],CategoriesPostComposer::class);


    }
}
