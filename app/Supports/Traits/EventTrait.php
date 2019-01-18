<?php
namespace App\Supports\Traits;

/**
 * 事件
 *
 * Class EventTrait
 *
 * @package App\Supports\Traits
 */

trait EventTrait
{
    protected $listeners = [];

    private static $baseListeners = [];

    /**
     * 获取事件绑定
     *
     * @return array
     */
    public static function getListeners()
    {
        return self::$baseListeners;
    }

    /**
     * 合并事件绑定
     */
    protected function mergeListeners()
    {
        self::$baseListeners += $this->listeners;
    }
}