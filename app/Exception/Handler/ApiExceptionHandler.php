<?php declare(strict_types=1);

namespace App\Exception\Handler;

use App\Exception\ApiException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * Class ApiExceptionHandler
 *
 * @since 2.0
 *
 * @ExceptionHandler(ApiException::class)
 */
class ApiExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $except
     * @param Response $response
     *
     * @return Response
     */
    public function handle(Throwable $except, Response $response): Response
    {
        $data = [
            'code' => $except->getCode(),
            'msg'  => $except->getMessage(),
            'data' => '',
        ];

        return $response->withData($data);
    }
}
