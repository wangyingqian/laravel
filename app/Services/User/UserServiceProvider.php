<?php
namespace App\Service\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('user', function ($app){
            return new UserManager($app);
        });
    }

    public function boot()
    {
        $userManager = $this->app->make('user');

        $userManager->boot();
    }
}