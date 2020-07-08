<?php


namespace App\Http\Admin\Service;


use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\ResourceDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

require ROOT . '/vendor/alibabacloud/voduploadsdk/Autoloader.php';

/**
 * Class UploadService
 * @Service()
 * @package App\Http\Admin\Service
 */
class UploadService
{
    /**
     * @Inject()
     * @var ResourceDao
     */
    private $resourceDao;

    /**
     * @param array $data
     * @return Error
     * @throws ApiException
     */
    public function uploadLocalVideo(array $data)
    {
        try {
            $result = $this->aliUploadVideo(ROOT . $data['filePath']);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), Constant::$FAIL_NUM);
        }

        $videoId = $result;
        $this->resourceDao->createVideo(0, '', $videoId, 0);
        return Error::instance(Constant::$SUCCESS_NUM);
    }

    /**
     * @param string $filePath
     * @return string
     * @throws \Exception
     */
    public function aliUploadVideo(string $filePath)
    {
        $uploader           = new \AliyunVodUploader(accessKeyId, accessKeySecret);
        $uploadVideoRequest = new \UploadVideoRequest($filePath, 'UploadLocalVideo');
        $userData           = array(
            "MessageCallback" => array("CallbackURL" => "http://xqbmini.szbdedu.com/MiniApi/Upload/getAliVideoReviewResult"),
            "Extend"          => array("localId" => "xxx", "test" => "www"),
        );
        $uploadVideoRequest->setUserData(json_encode($userData));
        $uploadVideoRequest->setWorkflowId('56a7c0b22a24361afc513297c12b793b');
        $res = $uploader->uploadLocalVideo($uploadVideoRequest);
        if ($res) {
            return $res;
        }
        return '';
    }
}
