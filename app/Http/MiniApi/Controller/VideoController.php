<?php


namespace App\Http\MiniApi\Controller;


use App\Exception\ApiException;
use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\VideoService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class VideoController
 * @Controller("/MiniApi/Video/")
 * @package App\Http\MiniApi\Controller
 */
class VideoController
{
    /**
     * @Inject()
     * @var VideoService
     */
    private $videoService;

    /**
     * @RequestMapping("getUploadInfo")
     * @Validate(validator="VideoPathValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function getUploadInfo(Request $request)
    {
        $videoPath = $request->post('videoPath');
        $result    = $this->videoService->getUploadInfo($videoPath);
        return ReturnMessage::success($result);
    }
}
