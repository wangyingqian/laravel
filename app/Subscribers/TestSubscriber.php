<?php
namespace App\Subscribers;

class TestSubscriber
{
    public function subscribe($event)
    {
        $event->listen(
            'App\Events\TestEvent@onTest',
            'App\Subscribers\TestSubscriber@onTest'
        );
    }

    public function onTest($event)
    {
        var_dump($event);
    }
}