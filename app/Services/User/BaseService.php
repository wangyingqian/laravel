<?php
namespace App\Services\User;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class BaseService
{
    protected $app;

    protected $dispatch;

    public function __construct(Application $app, Dispatcher $dispatcher = null)
    {
        $this->app = $app;
        $this->dispatch = $dispatcher;
    }
}