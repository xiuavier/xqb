<?php


namespace App\Http\MiniApi\Controller;


use App\Exception\ApiException;
use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\UserService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\ContentType;
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
     * 个人中心，获取用户信息
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

    /**
     * @RequestMapping("userAgreement")
     * @return \Swoft\Http\Message\Response|\Swoft\Rpc\Server\Response|\Swoft\Task\Response
     * @throws \Throwable
     */
    public function userAgreement()
    {
        $renderer = \Swoft::getBean('view');
        $content  = $renderer->render('user/userAgreement');
        return context()->getResponse()->withContentType(ContentType::HTML)->withContent($content);
    }

    /**
     * @RequestMapping("privacyPolicy")
     * @return \Swoft\Http\Message\Response|\Swoft\Rpc\Server\Response|\Swoft\Task\Response
     * @throws \Throwable
     */
    public function privacyPolicy()
    {
        $renderer = \Swoft::getBean('view');
        $content  = $renderer->render('user/privacyPolicy');
        return context()->getResponse()->withContentType(ContentType::HTML)->withContent($content);
    }

    /**
     * 获取用户作品列表
     * @RequestMapping("getUserPosts")
     * @Validate(validator="TokenValidator")
     * @Validate(validator="CurrentPageValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function getUserPosts(Request $request)
    {
        $token       = $request->post('token');
        $currentPage = $request->post('currentPage');
        $result      = $this->userService->getUserPosts($token, $currentPage);
        return ReturnMessage::success($result);
    }
}
