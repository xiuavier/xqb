<?php


namespace App\Http\Admin\Controller;


use App\Exception\ApiException;
use App\Http\Admin\Service\UploadService;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class UploadController
 * @Controller(prefix="/Admin/Upload/")
 * @package App\Http\Admin\Controller
 */
class UploadController
{
    /**
     * @Inject()
     * @var UploadService
     */
    private $uploadService;

    /**
     * 上传视频
     * @RequestMapping(route="uploadVideo")
     * @Middleware(AdminAuthMiddleware::class)
     * @Validate(validator="FilePathValidator")
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function uploadVideo(Request $request)
    {
        $data   = $request->post();
        $result = $this->uploadService->uploadLocalVideo($data);
        return ReturnMessage::success($result);
    }
}
