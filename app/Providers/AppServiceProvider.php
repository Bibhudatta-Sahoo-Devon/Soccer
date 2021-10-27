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
       $this->app->bind('App\Interfaces\PlayerRepositoryInterface','App\Repositories\PlayerRepository');
       $this->app->bind('App\Interfaces\TeamRepositoryInterface','App\Repositories\TeamRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
