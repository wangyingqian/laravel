<?php
namespace App\Events\User;

use App\Services\User\Member\Event\MemberCreate;

class UserEvent
{
    public function createMember(MemberCreate $memberCreate)
    {
//        dd($memberCreate->eventName, $memberCreate->title);
    }
}