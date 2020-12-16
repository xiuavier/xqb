<?php


namespace App\Http\Admin\Controller;


use App\Exception\ApiException;
use App\Http\Admin\Service\CourseService;
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
 * Class CourseController
 * @Controller(prefix="/Admin/Course/")
 * @package App\Http\Admin\Controller
 */
class CourseController
{
    /**
     * @Inject()
     * @var CourseService
     */
    private $courseService;

    /**
     * 新增课程
     * @RequestMapping(route="create")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="TitleValidator")
     * @Validate(validator="ThumbValidator")
     * @Validate(validator="VideoPathValidator")
     * @Validate(validator="TagValidator")
     * @Validate(validator="AttendTypeValidator")
     * @Validate(validator="DifficultyValidator")
     * @Validate(validator="DescriptionDataValidator")
     * @param Request $request
     * @return array
     * @throws ApiException
     * @throws DbException
     */
    public function create(Request $request)
    {
        $data   = $request->post();
        $result = $this->courseService->create($data);
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
     * 获取某个课程列表
     * @RequestMapping(route="list")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="CurrentPageValidator")
     * @Validate(validator="TitleNotRequiredValidator")
     * @Validate(validator="TagNotRequiredValidator")
     * @param Request $request
     * @return array
     * @throws ApiException
     * @throws DbException
     */
    public function list(Request $request)
    {
        $data   = $request->post();
        $result = $this->courseService->list($data);
        return ReturnMessage::success($result);
    }
}
