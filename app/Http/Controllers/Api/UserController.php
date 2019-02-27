<?php
namespace  App\Http\Controllers\Api;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function add(Request $request)
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abc']
        ];

        $client = ClientBuilder::create()->build();

    }
}