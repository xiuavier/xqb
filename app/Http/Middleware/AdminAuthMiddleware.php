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
use Swoft\Http\Session\HttpSession;
use Swoft\Redis\Pool;

/**
 * Class AdminAuthMiddleware
 *
 * @Bean()
 */
class AdminAuthMiddleware implements MiddlewareInterface
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
        $session = HttpSession::current();
        if (!$session->get('adminId')) {
            throw new ApiException('管理员未登录', Constant::$ADMIN_NOT_LOGIN);
        }

        return $handler->handle($request);
    }
}
