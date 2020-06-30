<?php


namespace App\Http\MiniApi\Service;

use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\PostDao;
use App\Model\Dao\ResourceDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class PostService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class PostService
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
     * @var ResourceDao
     */
    private $resourceDao;

    /**
     * @param array $data
     * @return Error
     * @throws DbException
     */
    public function lists(array $data)
    {
        if ($data['type'] == 2) {
            $posts = $this->postDao->getAllPosts($data['currentPage']);
            if (!$posts) {
                return Error::instance(Constant::$POST_LIST_EMPTY);
            }
        } else {
            $posts = $this->postDao->getPostsByType($data['type'], $data['currentPage']);
            if (!$posts) {
                return Error::instance(Constant::$POST_LIST_EMPTY);
            }
        }

        foreach ($posts['list'] as &$post) {
            $resource = $this->resourceDao->getResourceByPostId($post['id']);
            if ($resource) {
                $post['resource'] = $resource;
            } else {
                $post['resource'] = [];
            }
        }

        return Error::instance(Constant::$SUCCESS_NUM, $posts);
    }

    /**
     * @param array $data
     * @return Error
     */
    public function like(array $data)
    {
        $userInfo = $this->redis->hGetAll('token:' . $data['token']);
        if (!$userInfo) {
            return Error::instance(Constant::$USER_NOT_LOGIN);
        }

        //在redis中建立一个hash存储该用户点赞的记录
        if ($this->redis->hGet('userNo:' . $userInfo['userNo'] . ':postLike', $data['postId'])) {
            $this->redis->hSet('userNo:' . $userInfo['userNo'] . ':postLike', $data['postId'], 0);
        } else {
            $this->redis->hSet('userNo:' . $userInfo['userNo'] . ':postLike', $data['postId'], 1);
        }

        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
