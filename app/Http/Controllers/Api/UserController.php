<?php
namespace  App\Http\Controllers\Api;

use App\Services\User\Contract\MemberContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function add(Request $request)
    {
        return $this->make(MemberContract::class)->create();
    }
}