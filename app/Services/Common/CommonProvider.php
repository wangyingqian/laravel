<?php
namespace App\Services\Common;

use Illuminate\Support\ServiceProvider;

class CommonProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('user.service', function ($app){
            return new Comm($app);
        });
    }

    public function boot()
    {
        $userManager = $this->app->make('user.service');

        $userManager->boot();
    }
}