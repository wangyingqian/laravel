<?php

namespace App\Supports;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Throwable;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 响应处理类
 *
 * Class RestfulRespond
 *
 * @package App\Commons
 */
class RestfulRespond extends JsonResponse
{
    /**
     * 编码选项
     *
     * @var int
     */
    protected $encodingOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

    /**
     * 创建接口响应
     *
     * @param mixed $data
     * @param int $status
     */
    public function __construct($data = null, $status = 200)
    {
        if (config('app.debug')) {
            // 调试模式下美化 JSON 输出
            $this->encodingOptions |= JSON_PRETTY_PRINT;
        }

        parent::__construct($data, $status, [], false);
    }

    /**
     * 创建成功响应
     *
     * @param mixed $data
     *
     * @return static
     */
    public static function success($data)
    {
        $data = [
            'code' => isset($data['code']) ? (string)array_pull($data, 'code') :(string) 200,
            'message' => isset($data['message']) ? array_pull($data, 'message') : '',
            'data' => head(array_values($data))
        ];

        return new static($data, 200);
    }

    /**
     * 创建错误响应
     *
     * @param $code
     * @param $message
     * @param null $data
     * @param int $status
     * @param Throwable $e
     *
     * @return RestfulRespond|\Illuminate\Http\Response
     */
    public static function error($code, $message, $data = null, $status = 400, Throwable $e)
    {
        $data = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

        if (config('app.debug') && $e) {
            $exception = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => static::parseTrace($e),
                'previous' => []
            ];

            $previous = $e;

            while ($previous = $previous->getPrevious()) {
                $exception['previous'][] = [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => static::parseTrace($e),
                ];
            }

            $data['exception'] = $exception;
        }

        return new static($data, $status);
    }

    /**
     * 重定向
     *
     * @param int $status
     * @param string $message
     *
     * @return \Illuminate\Http\Response
     */
    public static function redirect($status = 200, $message = '')
    {
        if ($status == '404'){
            return Response::view('errors/404');
        }else{
            return Response::view('errors/302', ['message' => $message]);
        }
    }

    /**
     * 获得异常栈信息
     *
     * @param \Throwable $e
     *
     * @return array
     */
    protected static function parseTrace(Throwable $e)
    {
        $trace = $e->getTraceAsString();

        return explode("\n", $trace);
    }
}
