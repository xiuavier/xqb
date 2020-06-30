<?php


namespace App\Http\MiniApi\Service;

use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\PostDao;
use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class UserService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class UserService
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
     * @Inject()
     * @var PostDao
     */
    private $postDao;

    /**
     * @param string $token
     * @return Error
     */
    public function index(string $token): Error
    {
        $userInfo = $this->redis->hGetAll('token:' . $token);
        if ($userInfo) {
            return Error::instance(Constant::$SUCCESS_NUM, $userInfo);
        }

        return Error::instance(Constant::$FAIL_NUM);
    }

    /**
     * @param string $token
     * @param int $currentPage
     * @return Error
     * @throws DbException
     */
    public function getUserPosts(string $token, int $currentPage)
    {
        $userInfo = $this->redis->hGetAll('token:' . $token);
        if (!$userInfo) {
            return Error::instance(Constant::$USER_NOT_LOGIN);
        }

        if (!array_key_exists('userNo', $userInfo)) {
            return Error::instance(Constant::$FAIL_NUM);
        }

        $userId = $this->userDao->getUserByUserNo($userInfo['userNo']);

        $posts = $this->postDao->getUserPostsByUserNo($userId['id'], $currentPage);
        if (!$posts) {
            return Error::instance(Constant::$USER_HAS_NOT_POST_ANYTHING);
        }

        return Error::instance(Constant::$SUCCESS_NUM, $posts);
    }
}
