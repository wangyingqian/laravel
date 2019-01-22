<?php
namespace App\Services\Common;

use App\Services\Common\Contract\ImageUploadContract;
use App\Services\Common\Service\ImageUploadService;
use App\Services\User\Service\StoreService;
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
        $this->app->singleton(ImageUploadContract::class, function () {

            return new ImageUploadService($this->app, $this->dispatcher);
        });
    }

}