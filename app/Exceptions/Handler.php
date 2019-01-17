<?php
namespace App\Exceptions;

use App\Supports\RestfulException;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * 不需要报告的异常
     *
     * @var array
     */
    protected $dontReport = [
        RestfulException::class,
        ValidationException::class
    ];

    /**
     * 渲染异常到 Http 响应
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof RestfulException) {

        } elseif ($e instanceof NotFoundHttpException) {
            $e = RestfulException::convertNotFoundException($e);
        } elseif ($e instanceof RuntimeException || $e instanceof InvalidArgumentException) {
            $e = RestfulException::convertLaravelException($e);
        } elseif ($e instanceof ValidationException) {
            $e = RestfulException::convertValidationException($e);
        } elseif ($e instanceof HttpException || $e instanceof HttpResponseException) {
            $e = RestfulException::convertHttpException($e);
        } else {
            $e = RestfulException::convertException($e);
        }

        return $e->toResponse();
    }

    /**
     * 渲染异常到控制台输出
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param \Exception $e
     */
    public function renderForConsole($output, Exception $e)
    {
        if ($e instanceof ValidationException) {
            $e = new RuntimeException(
                $e->validator->errors()->first() ?? $e->getMessage(),
                $e->getCode(), $e
            );
        }
        parent::renderForConsole($output, $e);
    }

    /**
     * 错误报告
     *
     * @param Exception $e
     * @return mixed|void
     *
     * @throws Exception
     */
    public function report(Exception $e)
    {
        if ($this->shouldntReport($e)) {
            return;
        }

        if (method_exists($e, 'report')) {
            return $e->report();
        }

        try {
            $logger = $this->container->make(LoggerInterface::class);
        } catch (Exception $ex) {
            throw $e;
        }

        $logger->warning(
            $e->getMessage(),
            array_merge($this->context(), ['exception' => $e]
            ));
    }

}
