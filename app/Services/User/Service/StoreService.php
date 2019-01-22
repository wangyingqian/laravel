<?php
namespace App\Services\User\Service;

use App\Events\User\StoreEvent;
use App\Services\User\BaseService;
use App\Services\User\Contract\StoreContract;

/**
 * 商户服务
 *
 * Class StoreService
 *
 * @package App\Services\User\Service
 */
class StoreService extends BaseService implements StoreContract
{
    protected $listenerClass = StoreEvent::class;

    protected $listeners = [];

    public function create()
    {
        // TODO: Implement create() method.
    }

}