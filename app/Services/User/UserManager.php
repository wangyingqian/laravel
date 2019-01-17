<?php
namespace App\Services\User;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class UserManager
{
    protected $app;

    protected $dispatcher;

    public function __construct(Application $app, Dispatcher $dispatcher = null)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;
    }

    public function boot()
    {
        dd(123);
    }
}