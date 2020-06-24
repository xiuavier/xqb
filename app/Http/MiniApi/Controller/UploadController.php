<?php


namespace App\Http\MiniApi\Controller;


use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Exception\ApiException;
use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\UploadService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
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
     * @var UploadService
     */
    private $uploadService;

    /**
     * 获取视频上传地址和凭证
     * @RequestMapping("getVideoUploadInfo")
     * @Validate(validator="VideoPathValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws ClientException
     * @throws ServerException
     */
    public function getVideoUploadInfo(Request $request)
    {
        $videoPath = $request->post('videoPath');
        $result    = $this->uploadService->getVideoUploadInfo($videoPath);
        return ReturnMessage::success($result);
    }

    /**
     * 获取图片上传地址和凭证
     * @RequestMapping("getImageUploadInfo")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws ClientException
     * @throws ServerException
     */
    public function getImageUploadInfo(Request $request)
    {
        $result = $this->uploadService->getImageUploadInfo();
        return ReturnMessage::success($result);
    }

    /**
     * 新建图片推文
     * @RequestMapping("createPicturePost")
     * @Validate(validator="TitleValidator")
     * @Validate(validator="CourseIdValidator")
     * @Validate(validator="ActivityIdValidator")
     * @Validate(validator="ImageUrlsValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     * @throws ApiException
     */
    public function createPicturePost(Request $request)
    {
        $inputData = $request->input();
        $result    = $this->uploadService->createPicturePost($inputData);
        return ReturnMessage::success($result);
    }
}
