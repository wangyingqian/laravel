<?php
namespace App\Services\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('user', function ($app){
            return new UserManager($app, $app->make('events'));
        });
    }

    public function boot()
    {
        $userManager = $this->app->make('user');

        $userManager->boot();
    }
}