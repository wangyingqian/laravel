<?php
namespace  App\Http\Controllers;


use App\Events\TestEvent;
use App\Jobs\Test;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

Class TestController extends Controller
{
    public function index()
    {
        $arr = [
            [1,2,3],
            [4,5,3],
            ['a','b'],
            ['c'=>['a',2]]
        ];

        $collection = collect($arr)->collapse();

        return $collection;
    }


}