<?php
namespace App\Listeners\User;

use App\Events\User\UserEvent;

class TestListener
{
    public function test(UserEvent $event)
    {
        dd($event);
    }
}