<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Model\Entity\Resource;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;

/**
 * Class ResourceDao
 * @Bean()
 * @package App\Model\Dao
 */
class ResourceDao
{
    /**
     * @param int $userId
     * @param string $url
     * @param int $postId
     * @return bool
     * @throws ApiException
     */
    public function createPicture($userId, $url = '', $postId = 0)
    {
        DB::beginTransaction();
        try {
            $picture = new Resource();
            $picture->setUserId($userId);
            $picture->setUrl($url);
            $picture->setPostId($postId);
            $picture->setType(DatabaseCode::$POST_TYPE_PICTURE);
            $picture->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return true;
    }

    /**
     * @param $userId
     * @param string $url
     * @param string $videoId
     * @param int $postId
     * @return bool
     * @throws ApiException
     */
    public function createVideo($userId, $url = '', $videoId = '', $postId = 0)
    {
        DB::beginTransaction();
        try {
            $video = new Resource();
            $video->setUserId($userId);
            $video->setUrl($url);
            $video->setPostId($postId);
            $video->setAliId($videoId);
            $video->setType(DatabaseCode::$POST_TYPE_VIDEO);
            $video->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return true;
    }
}
