<?php
namespace App\Services\User;

use App\Services\User\Contract\MemberInterface;
use App\Services\User\Contract\ShopInterface;
use App\Services\User\Member\Member;
use App\Services\User\Shop\Shop;
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
        //注册内部服务
        $this->register();
    }

    /**
     * 注册服务
     */
    protected function register()
    {
        $this->app->singleton(MemberInterface::class, function () {
            return new Member($this->app, $this->dispatcher);
        });

        $this->app->singleton(ShopInterface::class, function () {
            return new Shop($this->app, $this->dispatcher);
        });

    }

}