<?php


namespace App\Http\MiniApi\Service;

use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Inject;
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
}
