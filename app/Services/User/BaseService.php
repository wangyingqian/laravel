<?php
namespace App\Services\User;

use App\Exceptions\ListenerException;
use http\Exception\RuntimeException;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;

class BaseService
{

    protected $app;

    protected $dispatcher;

    protected $listenerClass;

    protected $listeners = [];

    public function __construct(Application $app, Dispatcher $dispatcher)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;

        $this->registerEvent();
    }

    protected function registerEvent()
    {
        if (empty($this->listenerClass)){
            return true;
        }

        if (!class_exists($this->listenerClass)){
            throw new ListenerException('事件监听器定义错误');
        }

        foreach ($this->listeners as $listener => $event){
            $this->dispatcher->listen($event, $this->listenerClass.'@'.$listener);
        }

        return true;
    }


}