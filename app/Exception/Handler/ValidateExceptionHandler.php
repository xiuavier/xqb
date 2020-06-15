<?php declare(strict_types=1);


namespace App\Exception\Handler;

use App\Exception\ValidateException;
use App\Http\MiniApi\Common\Constant;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Throwable;
use const APP_DEBUG;

/**
 * Class ValidateExceptionHandler
 * 参数验证异常处理类
 * @ExceptionHandler(ValidateException::class)
 */
class ValidateExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $e
     * @param Response $response
     *
     * @return Response
     */
    public function handle(Throwable $e, Response $response): Response
    {
        // Log error message
        //参数验证异常不需要在控制台输出日志记录
//        Log::error($e->getMessage());
//        CLog::error('%s. (At %s line %d)', $e->getMessage(), $e->getFile(), $e->getLine());

        // Debug is false
//        if (!APP_DEBUG) {
//            return $response->withStatus(500)->withContent($e->getMessage());
//        }

        $data = [
            'code' => Constant::$PARAM_VALIDATE_FAIL,
            'msg'  => $e->getMessage(),
            'data' => '',
        ];

        // Debug is true
        return $response->withData($data);
    }
}
