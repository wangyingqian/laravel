<?php
namespace App\Services\User\Member;

use App\Events\User\UserEvent;
use App\Services\User\Contract\MemberInterface;
use App\Services\User\Member\Event\MemberCreate as MemberCreateEvent;
use App\Jobs\User\MemberCreate as MemberCreateJob;
use App\Services\User\User;

/**
 * 会员
 *
 * Class Member
 * User Administrator
 * Date 2019/1/18
 *
 * @package App\Services\User
 */
class Member extends User implements MemberInterface
{
    protected $listenerClass = UserEvent::class;

    protected $listeners = [
        'createMember' => MemberCreateEvent::class
    ];

    public function create()
    {
        $eventName = '发送邮件';
        $title = [
            'title_one' => 'title_one',
            'title_two' => 'title_two'
        ];

        //测试事件
        $this->dispatchEvent('createMember', $eventName, $title);

        //测试任务
        $jobData = [
            'job' => 'test'
        ];
        $this->dispatchJob(MemberCreateJob::class, $jobData);
    }
}