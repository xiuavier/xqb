<?php


namespace App\Http\MiniApi\Controller;


use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\ActivityService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class ActivityController
 * @Controller("/MiniApi/Activity/")
 * @package App\Http\MiniApi\Controller
 */
class ActivityController
{
    /**
     * @Inject()
     * @var ActivityService
     */
    private $activityService;

    /**
     * @RequestMapping("lists")
     * @Validate(validator="TokenValidator")
     * @Validate(validator="TypeValidator")
     * @Validate(validator="CurrentPageValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function lists(Request $request)
    {
        $data = $request->input();
        $result = $this->activityService->lists($data);
        return ReturnMessage::success($result);
    }
}
