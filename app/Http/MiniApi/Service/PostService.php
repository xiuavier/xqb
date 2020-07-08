<?php


namespace App\Http\MiniApi\Service;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\PostDao;
use App\Model\Dao\ResourceDao;
use App\Model\Dao\UserDao;
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
     * @Inject()
     * @var UserDao
     */
    private $userDao;

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
            //增加动态作者的用户信息
            $owner             = $this->userDao->getUserByID($post['userId']);
            $post['ownerInfo'] = $owner;

            $userInfo = $this->redis->hGetAll('token:' . $data['token']);
            //还需要判断当前登录的用户是否对该动态点赞
            $isLike = $this->redis->hGet(
                'userNo:' . $userInfo['userNo'] . ':postLike',
                'postId:' . $post['id']
            );
            if ($isLike) {
                $post['currentUserLike'] = 1;
            } else {
                $post['currentUserLike'] = 0;
            }

            $post['pictureUrls'] = [];
            $post['videoUrl']    = '';
            $post['coverUrl']    = '';
            //将每条动态所包含的资源加载出来
            $resource = $this->resourceDao->getResourceByPostId($post['id']);
            if ($resource) {
                if ($post['type'] == DatabaseCode::$POST_TYPE_VIDEO) {
                    //表示当前资源是视频，拿出来放到resource数组中
                    $post['videoUrl'] = $resource[0]['url'];
                    $post['coverUrl'] = $resource[0]['coverUrl'];
                } else {
                    //当前资源是图片，遍历一下然后放到数组中
                    foreach ($resource as $value) {
                        array_push($post['pictureUrls'], $value['url']);
                    }
                }
            }
        }

        return Error::instance(Constant::$SUCCESS_NUM, $posts);
    }

    /**
     * @param array $data
     * @return Error
     * @throws ApiException
     */
    public function like(array $data)
    {
        $userInfo = $this->redis->hGetAll('token:' . $data['token']);
        if (!$userInfo) {
            return Error::instance(Constant::$USER_NOT_LOGIN);
        }

        $result = $this->redis->hGet(
            'userNo:' . $userInfo['userNo'] . ':postLike',
            'postId:' . $data['postId']
        );
        //在redis中建立一个hash存储该用户点赞的记录
        if ($result) {
            $this->redis->hSet(
                'userNo:' . $userInfo['userNo'] . ':postLike',
                'postId:' . $data['postId'],
                0
            );

            //减少动态获赞数
            $this->postDao->descLikes($data['postId']);
        } else {
            $this->redis->hSet(
                'userNo:' . $userInfo['userNo'] . ':postLike',
                'postId:' . $data['postId'],
                1
            );
            //增加动态获赞数
            $this->postDao->addLikes($data['postId']);
        }

        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
