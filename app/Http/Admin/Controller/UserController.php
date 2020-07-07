<?php


namespace App\Http\Admin\Controller;


use App\Http\Admin\Service\UserService;
use App\Http\MiniApi\Common\ReturnMessage;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class UserController
 * @Controller(prefix="/Admin/User/")
 * @package App\Http\Admin\Controller
 */
class UserController
{
    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    /**
     * @RequestMapping(route="list")
     * @Validate(validator="CurrentPageValidator")
     * @Validate(validator="UserNoNotRequiredValidator")
     * @Validate(validator="NicknameNotRequiredValidator")
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function list(Request $request)
    {
        $data   = $request->post();
        $result = $this->userService->list($data);
        return ReturnMessage::success($result);
    }
}
