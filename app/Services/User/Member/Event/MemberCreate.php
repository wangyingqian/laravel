<?php
namespace App\Services\User\Member\Event;

class MemberCreate
{
    public $eventName;

    public $title;

    public function __construct($eventName, $title)
    {
        $this->eventName = $eventName;
        $this->title = $title;
    }
}