<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
       \URL::forceScheme('https');

 
    // adminのみ許可
    \Gate::define('admin', function ($user) {
        return ($user->admin_flag == 1);
    });
    }
}
