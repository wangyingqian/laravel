<?php
namespace App\Events;

use App\Services\User\Event\CreateMember;

class UserEvent
{
    public function createMember(CreateMember $createMember)
    {
        dd('event');
    }
}