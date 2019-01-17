<?php

namespace App\Http\Controllers;

use App\Exceptions\OperateMethodException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __invoke(Request $request, $type = 'GET')
    {
        $methodType = $request->get('type', $type);

        switch (strtoupper($methodType)){
            case 'GET':
                $this->get($request);
                break;
            case 'ADD':
                $this->add($request);
                break;
            case 'UPDATE':
                $this->update($request);
                break;
            case 'DELETE':
                $this->update($request);
                break;
            default:
                throw new OperateMethodException('不支持的操作方法');
        }
    }

    /**
     * 查询操作
     *
     * @param Request $request
     */
    protected function get(Request $request)
    {

    }

    /**
     * 新增操作
     *
     * @param Request $request
     */
    protected function add(Request $request)
    {

    }

    /**
     * 更新操作
     *
     * @param Request $request
     */
    protected function update(Request $request)
    {

    }

    /**
     * 删除操作
     *
     * @param Request $request
     */
    protected function delete(Request $request)
    {

    }
}
