<?php


namespace App\Http\Admin\Controller;


use App\Http\Admin\Service\AdService;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class AdController
 * @Controller(prefix="/Admin/Ad/")
 * @package App\Http\Admin\Controller
 */
class AdController
{
    /**
     * @Inject()
     * @var AdService
     */
    private $adService;

    /**
     * 新建广告
     * @RequestMapping(route="create")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="TitleValidator")
     * @Validate(validator="ThumbValidator")
     * @Validate(validator="RedirectTypeValidator")
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function create(Request $request)
    {
        $data   = $request->post();
        $result = $this->adService->create($data);
        return ReturnMessage::success($result);
    }
}
