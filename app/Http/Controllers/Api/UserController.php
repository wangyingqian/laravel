<?php
namespace  App\Http\Controllers\Api;

use App\Events\User\UserEvent;
use App\Services\User\Contract\MemberInterface;
use Illuminate\Http\Request;
use Lawechat\WeChat;

class UserController extends Controller
{
    public function add(Request $request)
    {
        $dispatch = app('events');
        $dispatch->dispatch(new UserEvent());
    }
}