<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
/*
 * Project By Abbas Laravel && Hadi Android
 * 25 October
 */
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
        Schema::defaultStringLength(191);
        if (!Cache::get("users"))
            Cache::forever("users",User::all());
    }
}
