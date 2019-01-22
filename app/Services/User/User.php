<?php
namespace App\Services\User;

use App\Supports\Traits\EventTrait;
use App\Supports\Traits\JobTrait;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class User
{
    use EventTrait, JobTrait;

    protected $app;

    public function __construct(Application $app, Dispatcher $dispatcher = null)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;

        $this->registerEvent();
    }
}