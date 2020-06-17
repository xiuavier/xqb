<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Contract\MiddlewareInterface;
use Swoft\Redis\Pool;

/**
 * Class TokenMiddleware
 *
 * @Bean()
 */
class TokenMiddleware implements MiddlewareInterface
{
    /**
     * @Inject()
     * @var Pool
     */
    private $redis;

    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface|Request $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @inheritdoc
     * @throws ApiException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!array_key_exists('token', $request->post())) {
            throw new ApiException('Token未传递', Constant::$USER_TOKEN_REQUIRE);
        }

        $exist = $this->redis->exists('token:' . $request->post('token'));
        if (!$exist) {
            throw new ApiException('用户未登录', Constant::$USER_NOT_LOGIN);
        }

        return $handler->handle($request);
    }
}
