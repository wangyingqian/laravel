<?php
namespace App\Services\Common;

use App\Supports\Traits\EventTrait;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Application;

class Common
{
    use EventTrait;

    protected $app;

    public function __construct(Application $app, Dispatcher $dispatcher)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;

        $this->registerEvent();
    }
}