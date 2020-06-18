<?php


namespace App\Http\MiniApi\Service;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Vod\Vod;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class VideoService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class VideoService
{
    /**
     * @Inject()
     * @var Pool
     */
    private $redis;
    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    /**
     * 阿里云-初始化视频点播服务
     * @param $accessKeyId
     * @param $accessKeySecret
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    public function initVodClient($accessKeyId, $accessKeySecret)
    {
        //点播服务的接入地区，接入区域标识，国内用的这个
        $regionId = 'cn-shanghai';
        AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
            ->regionId($regionId)
            ->connectTimeout(1)
            ->timeout(3)
            ->name(VOD_CLIENT_NAME);
    }

    /**
     * @param string $videoPath
     * @return Error
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function getUploadInfo(string $videoPath): Error
    {
        //获取视频上传地址和凭证
        $this->initVodClient(accessKeyId, accessKeySecret);
        $uploadVideoInfo    = $this->createUploadVideo($videoPath);
        $aliUploadVideoInfo = json_decode($uploadVideoInfo, true);
        //获取图片上传地址和凭证
        $uploadImgInfo                   = $this->createUploadImage();
        $aliUploadImgInfo                = json_decode($uploadImgInfo, true);
        $uploadInfo['video_upload_info'] = $aliUploadVideoInfo;
        $uploadInfo['image_upload_info'] = $aliUploadImgInfo;
        return Error::instance(Constant::$SUCCESS_NUM, $uploadInfo);
    }

    /**
     * 获取视频上传地址和凭证
     * @param $fileName
     * @return \AlibabaCloud\Client\Result\Result
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function createUploadVideo($fileName)
    {
        return Vod::v20170321()->createUploadVideo()->client(VOD_CLIENT_NAME)
            ->withTitle('xqb')// 指定接口参数
            ->withFileName($fileName)
            ->withTags('miniProgram')
            ->withWorkflowId('56a7c0b22a24361afc513297c12b793b')
            ->format('JSON')// 指定返回格式
            ->request();      // 执行请求
    }

    /**
     * 获取图片上传地址和凭证
     * @param string $ImageType
     * @return \AlibabaCloud\Client\Result\Result
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function createUploadImage($ImageType = 'default')
    {
        return Vod::v20170321()->createUploadImage()->client(VOD_CLIENT_NAME)
            ->withImageType($ImageType)// 指定接口参数
            ->format('JSON')// 指定返回格式
            ->request();      // 执行请求
    }
}
