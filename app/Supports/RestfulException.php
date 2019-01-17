<?php
namespace App\Supports;

use RuntimeException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * 异常处理类
 *
 * Class RestfulException
 *
 * @package App\Helpers
 */
class RestfulException extends RuntimeException
{
    /**
     * 附加数据
     *
     * @var mixed
     */
    protected $data;

    /**
     * 响应状态码
     *
     * @var int
     */
    protected $status = 200;

    /**
     * 是否重定向
     *
     * @var bool
     */
    protected $redirect = false;

    /**
     * 创建接口异常
     *
     * @param int $code
     * @param string $message
     * @param mixed $data
     * @param \Throwable $previous
     */
    public function __construct($code, $message, $data = [], \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->data = $data;
    }

    /**
     * 获得附加数据
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 设置响应状态码
     *
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * 获得响应状态码
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 转换验证器异常
     *
     * @param \Illuminate\Validation\ValidationException $e
     *
     * @return static
     */
    public static function convertValidationException(ValidationException $e)
    {
        $errors = $e->validator->errors();
        $message = $errors->first() ?: $e->getMessage();

        $data = [
            'errors'    => $errors->messages(),
            'error_bag' => $e->errorBag
        ];

        $exception = new static(422, $message, $data, $e);
        $exception->setStatus(200);

        return $exception;
    }

    /**
     * 转换 Http 异常
     *
     * @param \Exception $e
     *
     * @return static
     */
    public static function convertHttpException(\Exception $e)
    {
        if ($e instanceof HttpException) {

            $status = $e->getStatusCode();
            $content = $e->getMessage();
        } elseif ($e instanceof HttpResponseException) {
            $response = $e->getResponse();
            $status = $response->getStatusCode();
            $content = $response->getContent();
        } else {
            $status = 500;
            $content = $e->getMessage();
        }

        $message = isset(Response::$statusTexts[$status]) ? Response::$statusTexts[$status] : 'Unknown';

        $exception = new static($status, $message, $content, $e);
        $exception->setStatus($status);

        return $exception;
    }

    /**
     * 转换框架异常
     *
     * @param $e
     *
     * @return RestfulException
     */
    public static function convertLaravelException(\Exception $e)
    {
        $code = 0;

        if ($e instanceof RuntimeException){
            $code = $e->getCode() ?: 1;
        }

        if ($e instanceof InvalidArgumentException){
            $code = $e->getCode() ?: 2;
        }

        $message = $e->getMessage();

        return new static($code, $message, new \stdClass(), $e);
    }

    /**
     * 转换普通异常
     *
     * @param \Exception $e
     *
     * @return static
     */
    public static function convertException(\Exception $e)
    {
        $message = $e->getMessage();

        $exception = new static(500, $message, new \stdClass(), $e);
        $exception->setStatus(500);

        if (!config('app.debug')){
            $exception->redirect = true;
        }

        return $exception;
    }

    /**
     * 转换 404 异常
     *
     * @param \Exception $e
     *
     * @return RestfulException
     */
    public static function convertNotFoundException(\Exception $e)
    {
        $exception = new static($e->getCode(), $e->getMessage(), new \stdClass(), $e);
        $exception->setStatus($e->getStatusCode());

        if (!config('app.debug')){
            $exception->redirect = true;
        }


        return $exception;
    }

    /**
     * 生成异常对象
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse()
    {
        return $this->redirect
            ? RestfulRespond::redirect(
                $this->getStatus(),
                $this->getMessage()
            )
            : RestfulRespond::error(
            (string) $this->getCode(),
            $this->getMessage(),
            $this->getData(),
            $this->getStatus(),
            $this->getPrevious()
        );
    }
}
