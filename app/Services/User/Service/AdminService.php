<?php
namespace App\Services\User\Service;

use App\Events\User\AdminEvent;
use App\Services\User\BaseService;
use App\Services\User\Contract\AdminContract;

class AdminService extends BaseService implements AdminContract
{
    protected $listenerClass = AdminEvent::class;

    protected $listeners = [];

    public function create()
    {
        // TODO: Implement create() method.
    }
}