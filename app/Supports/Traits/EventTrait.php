<?php
namespace App\Supports\Traits;

use App\Exceptions\ListenerException;
use Illuminate\Events\Dispatcher;

trait EventTrait
{
    private $dispatcher;

    protected $listenerClass;

    protected $listeners = [];

    protected function registerEvent()
    {
        if (empty($this->listenerClass) || empty($this->dispatcher)){
            return true;
        }

        if (!class_exists($this->listenerClass)){
            throw new ListenerException('事件监听器定义错误');
        }

        if ($this->dispatcher instanceof Dispatcher){
            foreach ($this->listeners as $listener => $event){
                $this->dispatcher->listen($event, $this->listenerClass.'@'.$listener);
            }
        }

        return true;
    }

    protected function dispatchEvent($listener, ...$args)
    {
        if (isset($this->listeners[$listener])){
            return $this->dispatcher->dispatch(new $this->listeners[$listener](...$args));
        }

        return true;
    }

}