<?php

namespace App\Providers;

use App\Http\View\Composers\AmountProductComposer;
use App\Http\View\Composers\ListProductCartComposer;
use App\Http\View\Composers\MenuComposer;
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
        Facades\View::composer(['client.header','client.banner','client.product'],MenuComposer::class);
        Facades\View::composer(['client.slider'],SliderComposer::class);
        Facades\View::composer(['client.product'],ProductComposer::class);
        Facades\View::composer('client.header',AmountProductComposer::class);
        Facades\View::composer(['client.cart','email.formemail'],ListProductCartComposer::class);
    }
}
