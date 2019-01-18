<?php
namespace App\Services\User\Service;

use App\Services\User\BaseService;
use App\Services\User\Contract\MemberContract;

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
    public function create()
    {
        dd('user');
    }
}