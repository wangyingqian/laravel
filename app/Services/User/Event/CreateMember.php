<?php
namespace App\Services\User\Event;

class CreateMember
{
    public function __construct()
    {
        dd('event fire');
    }
}