<?php
namespace  App\Http\Controllers\Api;

use App\Services\User\Contract\MemberInterface;
use Illuminate\Http\Request;
use Lawechat\WeChat;

class UserController extends Controller
{
    public function add(Request $request)
    {
        $config = [
            'app_id' => 'wx3cf0f39249eb0exx',
            'secret' => 'f1c242f4f28f735d4687abb469072axx',

        ];
        $wechat = WeChat::make('official_account', $config)->menugit;
dd($wechat);
        return $wechat;
        return $this->make(MemberInterface::class)->create();
    }
}