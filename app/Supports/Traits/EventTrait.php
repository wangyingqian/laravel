<?php
namespace App\Supports\Traits;

trait  EventTrait
{
    protected $listeners = [];

    private static $baseListeners = [];

    public static function getListeners()
    {
        return self::$baseListeners;
    }

    protected function mergeListeners()
    {
        self::$baseListeners += $this->listeners;
    }
}