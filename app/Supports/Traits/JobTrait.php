<?php
namespace App\Supports\Traits;

use Illuminate\Contracts\Queue\ShouldQueue;

trait JobTrait
{
    protected function dispatchJob($className, $data, $queue = 'default')
    {
        if (class_implements($className, ShouldQueue::class) && method_exists($className, 'dispatch')){
            return $className::dispatch($data)->onQueue($queue);
        }

        return true;
    }
}