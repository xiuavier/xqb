<?php


namespace App\Http\MiniApi\Controller;


use App\Exception\ApiException;
use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\LoginService;
use App\Model\Entity\User;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class LoginController
 * @Controller("/MiniApi/Login/")
 * @package App\Http\MiniApi\Controller
 */
class LoginController
{
    /**
     * @Inject()
     * @var LoginService
     */
    private $loginService;

    /**
     * @RequestMapping("getToken")
     * @Validate(validator="CodeValidator")
     * @param Request $request
     * @return array
     * @throws DbException
     * @throws ApiException
     */
    public function getToken(Request $request)
    {
        print_r(phpinfo());
//        $code   = $request->post('code');
//        $result = $this->loginService->getToken($code);
//        return ReturnMessage::success($result);
    }

    /**
     * @RequestMapping("completeWxUserInfo")
     * @Validate(validator="TokenValidator")
     * @Validate(validator="UserInfoValidator")
     * @Validate(validator="IvValidator")
     * @Validate(validator="EncryptedDataValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws ApiException
     * @throws DbException
     */
    public function completeWxUserInfo(Request $request)
    {
        $token         = $request->post('token');
        $userInfo      = $request->post('userInfo');
        $iv            = $request->post('iv');
        $encryptedData = $request->post('encryptedData');
        $result        = $this->loginService->completeWxUserInfo($token, $userInfo, $iv, $encryptedData);
        return ReturnMessage::success($result);
    }

    /**
     * @RequestMapping("test")
     */
    public function test()
    {
        $user = new User();
        return $user;
    }
}
