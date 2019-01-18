<?php
namespace App\Services\User;

use App\Events\UserEvent;
use App\Services\User\Contract\MemberContract;
use App\Services\User\Event\CreateMember;
use App\Services\User\Service\MemberService;
use Illuminate\Foundation\Application;

class UserManager
{
    protected $app;
    protected $dispatcher;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->dispatcher = $this->app->make('events');
    }

    public function boot()
    {
        //注册服务
        $this->register();

        //注册事件
        $this->event();

    }

    protected function register()
    {
        $this->app->singleton(MemberContract::class, function () {
            return new MemberService($this->app, $this->dispatcher);
        });
    }

    protected function event()
    {
        $listens = [
            'createMember' => CreateMember::class
        ];

        foreach ($listens as $listen => $event){
            $this->dispatcher->listen($event, UserEvent::class.'@'.$listen);
        }

    }
}