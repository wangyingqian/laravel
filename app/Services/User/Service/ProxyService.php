<?php
namespace App\Services\User\Service;

use App\Services\User\BaseService;
use App\Services\User\Contract\ProxyContract;

class ProxyService extends BaseService implements ProxyContract
{
    protected $listeners = [];

    public function create()
    {
        // TODO: Implement create() method.
    }
}