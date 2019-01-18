<?php
namespace App\Services\User\Service;

use App\Services\User\BaseService;
use App\Services\User\Contract\MemberContract;
use App\Services\User\Event\CreateMember;

/**
 * 会员
 *
 * Class Member
 * User Administrator
 * Date 2019/1/18
 *
 * @package App\Services\User
 */
class MemberService extends BaseService implements MemberContract
{

    protected $listeners = [
        'createMember' => CreateMember::class
    ];

    public function create()
    {
        $this->dispatch->dispatch(new CreateMember());
    }
}