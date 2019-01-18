<?php
namespace App\Services\User;

use App\Services\User\Contract\MemberContract;
use App\Services\User\Service\MemberService;
use Illuminate\Foundation\Application;

class UserManager
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function boot()
    {
        //注册会员服务
        $this->app->singleton(MemberContract::class, function () {
            return new MemberService($this->app, $this->app->make('events'));
        });
    }
}