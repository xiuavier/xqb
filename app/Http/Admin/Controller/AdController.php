<?php
namespace App\Http\Admin\Controller;


use App\Exception\ApiException;
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
     * 新增广告
     * @RequestMapping(route="create")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="TitleValidator")
     * @Validate(validator="ThumbValidator")
     * @Validate(validator="RedirectTypeValidator")
     * @Validate(validator="PublishStatusValidator")
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function create(Request $request)
    {
        $data   = $request->post();
        $result = $this->adService->create($data);
        return ReturnMessage::success($result);
    }

    /**
     * 更新广告
     * @RequestMapping(route="update")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="IdValidator")
     * @Validate(validator="PublishStatusValidator")
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function update(Request $request)
    {
        $data   = $request->post();
        $result = $this->adService->update($data);
        return ReturnMessage::success($result);
    }

    /**
     * 获取广告列表
     * @RequestMapping(route="list")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="CurrentPageValidator")
     * @Validate(validator="TitleNotRequiredValidator")
     * @Validate(validator="PublishStatusNotRequiredValidator")
     * @param Request $request
     * @return array
     * @throws ApiException
     * @throws DbException
     */
    public function list(Request $request)
    {
        $data   = $request->post();
        $result = $this->adService->list($data);
        return ReturnMessage::success($result);
    }
}
