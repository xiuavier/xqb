<?php


namespace App\Http\MiniApi\Service;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Vod\Vod;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\ActivityDao;
use App\Model\Dao\PostDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class VideoService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class UploadService
{
    /**
     * @Inject()
     * @var Pool
     */
    private $redis;
    /**
     * @Inject()
     * @var PostDao
     */
    private $postDao;

    /**
     * @Inject()
     * @var ActivityDao
     */
    private $activityDao;

    /**
     * 获取视频上传地址和凭证
     * @param string $videoPath
     * @return Error
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function getVideoUploadInfo(string $videoPath): Error
    {
        //获取视频上传地址和凭证
        $this->initVodClient(accessKeyId, accessKeySecret);
        $uploadVideoInfo    = $this->createUploadVideo($videoPath);
        $aliUploadVideoInfo = json_decode($uploadVideoInfo, true);
        return Error::instance(Constant::$SUCCESS_NUM, $aliUploadVideoInfo);
    }

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
     * @return Error
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function getImageUploadInfo()
    {
        $this->initVodClient(accessKeyId, accessKeySecret);
        $uploadInfo    = $this->createUploadImage();
        $aliUploadInfo = json_decode($uploadInfo);
        return Error::instance(Constant::$SUCCESS_NUM, $aliUploadInfo);
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

    /**
     * @param array $inputData
     * @return Error
     * @throws DbException
     */
    public function createPost(array $inputData)
    {
        //先要建立推文，然后到资源表中插入一条条数据

        //先获取到活动的信息
        $activity = $this->activityDao->getOne($inputData['activityId']);
        if (!$activity) {
            return Error::instance(Constant::$ACTIVITY_NOT_EXISTS);
        }

        //然后新建post
        //TODO
        $postData = [
            'title'       => $inputData['title'],
            'tag'         => $activity['tag'],
            'activity_id' => $inputData['activityId'],
            'course_id'   => $inputData['courseId'],
        ];
        $post     = $this->postDao->create($postData);
        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
