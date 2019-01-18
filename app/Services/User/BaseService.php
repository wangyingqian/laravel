<?php
namespace App\Services\User;

use App\Supports\Traits\EventTrait;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class BaseService
{

    protected $app;

    protected $dispatcher;

    protected $listeners = [];

    public function __construct(Application $app, Dispatcher $dispatcher)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;
    }

    protected function registerEvent()
    {
        foreach ($this->listeners as $listener => $event)
        {

        }
    }

}