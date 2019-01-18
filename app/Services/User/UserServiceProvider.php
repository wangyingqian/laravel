<?php
namespace App\Services\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('user.service', function ($app){
            return new UserManager($app);
        });
    }

    public function boot()
    {
        $userManager = $this->app->make('user.service');

        $userManager->boot();
    }
}