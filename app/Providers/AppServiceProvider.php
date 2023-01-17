<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // برای نمایش دسترسی ها مشترک shop , admin
        Blade::if('admins', function () {
            return auth()->check() && (auth()->user()->is('admin') || auth()->user()->is('shop') );
        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->is('admin');
        });

        Blade::if('shop', function () {
            return auth()->check() && auth()->user()->is('shop');
        });

        Blade::if('user', function () {
            return auth()->check() && auth()->user()->is('user');
        });

        // استفاده از صفحه بندی بوت استرپ
        // dd(url()->current()); // url فعلی را می دهد
        // چون در بخش ادمین از tailwindcss استفاده کردیم و در بخش landing از بوت استرپ
        // dd(request()->path()); // مسیر فعلی را می دهد.

        if (strpos(request()->path(), 'landing') === 0) {
            Paginator::useBootstrapFive();
         }
        
    }
}
