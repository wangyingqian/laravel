<?php
namespace App\Services\User;

use App\Supports\Traits\EventTrait;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class BaseService
{
    use EventTrait;

    protected $app;

    protected $dispatch;

    public function __construct(Application $app, Dispatcher $dispatcher = null)
    {
        $this->app = $app;
        $this->dispatch = $dispatcher;

        $this->mergeListeners();
    }

}