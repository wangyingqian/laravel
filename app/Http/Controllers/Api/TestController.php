<?php
namespace  App\Http\Controllers\Api;

use App\Services\User\Contract\MemberContract;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get(Request $request)
    {
        return $this->make(MemberContract::class)->create();
    }
}