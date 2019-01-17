<?php
namespace  App\Http\Controllers\Api;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get(Request $request)
    {
        $arr = [
            [1,2,3],
            [4,5,3],
            ['a','b'],
            ['c'=>['a',2]]
        ];

        $collection = collect($arr)->collapse();

        $data = [
            'message' => '测试成功',
            'data' => $collection->toArray()
        ];

        return $data;
    }
}