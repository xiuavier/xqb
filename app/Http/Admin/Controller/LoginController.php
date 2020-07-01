<?php


namespace App\Http\Admin\Controller;


use App\Http\Admin\Service\LoginService;
use App\Http\MiniApi\Common\ReturnMessage;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class AdminController
 * @Controller(prefix="/Admin/Login/")
 * @package App\Http\Admin\Controller
 */
class LoginController
{
    /**
     * @Inject()
     * @var LoginService
     */
    private $loginService;

    /**
     * @RequestMapping(route="login")
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $data   = $request->post();
        $result = $this->loginService->login($data);
        return ReturnMessage::success($result);
    }
}
