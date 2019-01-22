<?php
namespace App\Services\Common;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('common.service', function ($app){
            return new CommonManager($app);
        });
    }

    public function boot()
    {
        $commonManager = $this->app->make('common.service');

        $commonManager->boot();
    }
}