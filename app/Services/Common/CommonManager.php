<?php
namespace App\Services\Common;

use App\Services\Common\Wechat\Wechat;
use Illuminate\Foundation\Application;

class CommonManager
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
        //微信服务
        $this->app->singleton(Wechat::class, function () {
            return new Wechat($this->app, $this->dispatcher);
        });
    }

}