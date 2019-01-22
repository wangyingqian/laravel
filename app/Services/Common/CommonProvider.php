<?php
namespace App\Services\Common;

use Illuminate\Support\ServiceProvider;

class CommonProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('common.service', function ($app){
            return new CommonProvider($app);
        });
    }

    public function boot()
    {
        $userManager = $this->app->make('common.service');

        $userManager->boot();
    }
}