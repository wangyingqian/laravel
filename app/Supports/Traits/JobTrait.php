<?php
namespace App\Supports\Traits;

use Illuminate\Contracts\Queue\ShouldQueue;

trait JobTrait
{
    private $job;

    protected function dispatchJob($className, $data, $queue = 'default')
    {
        if (class_implements($className, ShouldQueue::class) && method_exists($className, 'dispatch')){
           $this->job = $className::dispatch($data)->onQueue($queue);
        }

        return $this;
    }

    protected function delayMinute($minute)
    {
        if (!empty($this->job)){
            $this->job->delay(now()->addMinutes($minute));
        }
    }

    protected function delaySecond($second)
    {
        if (!empty($this->job)){
            $this->job->delay(now()->addSecond($second));
        }
    }
}