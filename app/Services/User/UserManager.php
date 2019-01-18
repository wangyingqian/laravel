<?php
namespace App\Services\User;

use App\Events\UserEvent;
use App\Services\User\Contract\AdminContract;
use App\Services\User\Contract\MemberContract;
use App\Services\User\Contract\ProxyContract;
use App\Services\User\Contract\StoreContract;
use App\Services\User\Event\CreateMember;
use App\Services\User\Service\AdminService;
use App\Services\User\Service\MemberService;
use App\Services\User\Service\ProxyService;
use App\Services\User\Service\StoreService;
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

    /**
     * 注册服务
     */
    protected function register()
    {
        $this->app->singleton(MemberContract::class, function () {

            return new MemberService($this->app, $this->dispatcher);
        });

        $this->app->singleton(StoreContract::class, function () {
            return new StoreService($this->app, $this->dispatcher);
        });

        $this->app->singleton(ProxyContract::class, function () {
            return new ProxyService($this->app, $this->dispatcher);
        });

        $this->app->singleton(AdminContract::class, function () {
            return new AdminService($this->app, $this->dispatcher);
        });
    }

    /**
     * 绑定事件
     */
    protected function event()
    {
        foreach (BaseService::getListeners() as $listen => $event){
            $this->dispatcher->listen($event, UserEvent::class.'@'.$listen);
        }

    }

}