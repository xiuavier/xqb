<?php


namespace App\Http\MiniApi\Service;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Client\Result\Result;
use AlibabaCloud\Vod\Vod;
use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\ActivityDao;
use App\Model\Dao\PostDao;
use App\Model\Dao\ResourceDao;
use App\Model\Dao\UserDao;
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
     * @Inject()
     * @var ResourceDao
     */
    private $resourceDao;

    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    /**
     * 获取视频上传地址和凭证
     * @param string $videoPath
     * @return Error
     * @throws ClientException
     * @throws ServerException
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
     * @throws ClientException
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
     * @return Result
     * @throws ClientException
     * @throws ServerException
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
     * @throws ClientException
     * @throws ServerException
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
     * @return Result
     * @throws ClientException
     * @throws ServerException
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
     * @throws ApiException
     */
    public function createPicturePost(array $inputData)
    {
        //先获取到活动的信息
        $activity = $this->activityDao->getOne($inputData['activityId']);
        if (!$activity) {
            return Error::instance(Constant::$ACTIVITY_NOT_EXISTS);
        }

        //获取用户的id
        $loginUser = $this->redis->hGetAll('token:' . $inputData['token']);
        $user      = $this->userDao->getUserByUserNo($loginUser['userNo']);
        if (!$user) {
            return Error::instance(Constant::$USER_NOT_EXIST);
        }

        //然后新建post
        $postData = [
            'user_id'       => $user['id'],
            'title'         => $inputData['title'],
            'tag'           => $activity['tag'],
            'activity_id'   => $inputData['activityId'],
            'course_id'     => $inputData['courseId'],
            'type'          => DatabaseCode::$POST_TYPE_PICTURE,
            'activity_type' => $activity['type']
        ];
        $post     = $this->postDao->create($postData);

        //资源表中建立资源
        foreach ($inputData['imageUrls'] as $imageUrl) {
            $this->resourceDao->createPicture($user['id'], $imageUrl, $post['id']);
        }
        return Error::instance(Constant::$SUCCESS_NUM);
    }

    /**
     * @param array $inputData
     * @return Error
     * @throws ApiException
     * @throws DbException
     */
    public function createVideoPost(array $inputData)
    {
        //先获取到活动的信息
        $activity = $this->activityDao->getOne($inputData['activityId']);
        if (!$activity) {
            return Error::instance(Constant::$ACTIVITY_NOT_EXISTS);
        }

        //获取用户的id
        $loginUser = $this->redis->hGetAll('token:' . $inputData['token']);
        $user      = $this->userDao->getUserByUserNo($loginUser['userNo']);
        if (!$user) {
            return Error::instance(Constant::$USER_NOT_EXIST);
        }

        //然后新建post
        $postData = [
            'user_id'       => $user['id'],
            'title'         => $inputData['title'],
            'tag'           => $activity['tag'],
            'activity_id'   => $inputData['activityId'],
            'course_id'     => $inputData['courseId'],
            'type'          => DatabaseCode::$POST_TYPE_VIDEO,
            'activity_type' => $activity['type']
        ];
        $post     = $this->postDao->create($postData);

        //资源表中建立资源
        $this->resourceDao->createVideo($user['id'], $inputData['videoUrl'], $inputData['videoId'], $post['id']);
        return Error::instance(Constant::$SUCCESS_NUM);
    }

    /**
     * @param $inputData
     * @return bool
     * @throws ClientException
     * @throws DbException
     * @throws ServerException
     * @throws ApiException
     */
    public function getAliVideoReviewResult($inputData)
    {
        $videoId = $inputData['VideoId'];
        //先要获取到数据库中的该资源对象
        $resource = $this->resourceDao->getResourceByAliId($videoId);
        if (!$resource) {
            return false;
        }

        //表示资源表中有该资源，将该资源对应的post的审核状态变为通过审核
        $client = $this->initVodClient(accessKeyId, accessKeySecret);
        if ($inputData['Status'] != 'success') {
            //表示没有通过审核
            $this->postDao->reviewFail($resource['postId']);
            return true;
        }

        //表示通过阿里云审核，还要进行人工审核
        $this->createAudit($client, $videoId, 'Normal');
        $info = $this->getAuditHistory($videoId);
        $Info = json_decode($info, true);

        if ($Info['Status'] != 'Normal') {
            $this->postDao->reviewFail($resource['postId']);
            return true;
        }

        $videoPlayInfo = $this->getPlayInfo($videoId);
        $videoPlayInfo = json_decode($videoPlayInfo, true);
        if (empty($videoPlayInfo)) {
            $this->postDao->reviewFail($resource['postId']);
            return false;
        }

        //更新资源表中视频资源的url和封面url
        $data['url']       = $videoPlayInfo['PlayInfoList']['PlayInfo'][0]['PlayURL'];
        $data['cover_url'] = $videoPlayInfo['VideoBase']['CoverURL'];
        $result            = $this->resourceDao->update($resource['id'], $data);
        if (!$result) {
            $this->postDao->reviewFail($resource['postId']);
            return false;
        }

        //更新推文表中的审核状态，改为审核通过
        $this->postDao->reviewPass($resource['postId']);
        return true;
    }

    /**
     * 阿里云-人工审核
     * @param $client
     * @param $videoID
     * @param $status
     * @return Result
     * @throws ClientException
     * @throws ServerException
     */
    public function createAudit($client, $videoID, $status)
    {
        return Vod::v20170321()->createAudit()->client(VOD_CLIENT_NAME)
            ->withAuditContent($this->buildAuditContent($client, $videoID, $status))// 指定接口参数
            ->format('JSON')// 指定返回格式
            ->request();      // 执行请求
    }

    /**
     * 阿里云-人工审核，构建审核内容
     * @param $client
     * @param $videoID
     * @param string $status
     * @return false|string
     */
    public function buildAuditContent($client, $videoID, $status = 'Blocked')
    {
        $auditContent             = array();
        $auditContent1            = array();
        $auditContent1["VideoId"] = $videoID; // 视频ID
        $auditContent1["Status"]  = $status; // 审核状态
        $auditContent1["Reason"]  = "nothing to say"; // 若审核状态为屏蔽时，需给出屏蔽的理由，最长支持128字节
        $auditContent[]           = $auditContent1;
        return json_encode($auditContent);
    }

    /**
     * 阿里云-获取人工审核历史
     * @param $videoID
     * @return Result
     * @throws ClientException
     * @throws ServerException
     */
    public function getAuditHistory($videoID)
    {
        return Vod::v20170321()->getAuditHistory()->client(VOD_CLIENT_NAME)
            ->withVideoId($videoID)// 指定接口参数
            ->format('JSON')// 指定返回格式
            ->request();      // 执行请求
    }

    /**
     * 阿里云-获取播放地址
     * @param $videoId
     * @return Result
     * @throws ClientException
     * @throws ServerException
     */
    public function getPlayInfo($videoId)
    {
        return Vod::v20170321()->getPlayInfo()->client(VOD_CLIENT_NAME)
            ->withVideoId($videoId)// 指定接口参数
            ->withAuthTimeout(3600 * 24)
            ->format('JSON')// 指定返回格式
            ->request();      // 执行请求
    }
}
