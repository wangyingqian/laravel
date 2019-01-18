<?php
namespace App\Services\User;

use App\Supports\Traits\EventTrait;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class BaseService
{
    use EventTrait;

    protected $app;

    protected $dispatcher;

    public function __construct(Application $app, Dispatcher $dispatcher)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;

        $this->mergeListeners();
    }

}