<?php


namespace App\Http\MiniApi\Controller;


use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\VideoService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class UploadController
 * @Controller("/MiniApi/Upload/")
 * @package App\Http\MiniApi\Controller
 */
class UploadController
{
    /**
     * @Inject()
     * @var VideoService
     */
    private $videoService;

    /**
     * 获取视频上传地址和凭证
     * @RequestMapping("getVideoUploadInfo")
     * @Validate(validator="VideoPathValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function getVideoUploadInfo(Request $request)
    {
        $videoPath = $request->post('videoPath');
        $result    = $this->videoService->getVideoUploadInfo($videoPath);
        return ReturnMessage::success($result);
    }

    /**
     * 获取图片上传地址和凭证
     * @RequestMapping("getImageUploadInfo")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function getImageUploadInfo(Request $request)
    {
        $result    = $this->videoService->getImageUploadInfo();
        return ReturnMessage::success($result);
    }
}
