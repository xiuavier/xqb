<?php


namespace App\Http\MiniApi\Controller;


use App\Exception\ApiException;
use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\UserService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class UserController
 * @Controller("/MiniApi/User/")
 * @package App\Http\MiniApi\Controller
 */
class UserController
{
    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    /**
     * @RequestMapping("index")
     * @Validate(validator="TokenValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     * @throws ApiException
     */
    public function index(Request $request)
    {
        $token  = $request->post('token');
        $result = $this->userService->index($token);
        return ReturnMessage::success($result);
    }
}
