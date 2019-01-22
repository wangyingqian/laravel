<?php
namespace App\Events\User;

use App\Services\User\Event\CreateMember;

class UserEvent
{
    public function createMember(CreateMember $createMember)
    {
        dd($createMember);
    }
}