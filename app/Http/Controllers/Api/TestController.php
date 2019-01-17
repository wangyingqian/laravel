<?php
namespace  App\Http\Controllers\Api;

class TestController extends Controller
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