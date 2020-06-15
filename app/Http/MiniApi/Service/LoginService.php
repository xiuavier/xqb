<?php


namespace App\Http\MiniApi\Service;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Http\MiniApi\Common\Wx;
use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class LoginService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class LoginService
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
     * @param string $code
     * @return Error
     * @throws DbException
     * @throws ApiException
     */
    public function getToken(string $code): Error
    {
        $result   = curl_get((new Wx())->getWxLoginUrl($code));
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            return Error::instance(Constant::$FAIL_NUM, '', '获取微信token失败');
        }
        if (array_key_exists('errcode', $wxResult)) {
            return Error::instance(Constant::$FAIL_NUM, '', $wxResult['errmsg']);
        }

        //调用公共方法，生成微信token
        $token      = generateWxToken();
        $openID     = $wxResult['openid'];
        $sessionKey = $wxResult['session_key'];
        //在缓存中保存对应token和openid微信用户的sessionKey，并且设置过期时间
        $this->redis->set('token_' . $token . '_session_key', $sessionKey, Wx::$EXPIRE_TIME);

        //需要判断下该openid的微信用户是否注册过
        $hasRegistered = $this->userDao->getUserByOpenID($openID);
        if ($hasRegistered) {
            //表明该openid已有用户注册，返回token
            foreach ($hasRegistered as $key => $value) {
                $this->redis->hSet('user_' . $token, $key, $value);
            }
            $this->redis->expire('user_' . $token, Wx::$EXPIRE_TIME);
            return Error::instance(Constant::$SUCCESS_NUM, ['token' => $token], '用户已注册');
        }
        //表明该openid没有用户注册，新建用户
        $res = $this->userDao->create(['open_id' => $openID]);
        if (!$res) {
            return Error::instance(Constant::$FAIL_NUM, '', '新建用户失败');
        }
        foreach ($res as $k => $v) {
            $this->redis->hSet('user_' . $token, $k, $v);
        }
        //设置用户缓存过期时间
        $this->redis->expire('user_' . $token, Wx::$EXPIRE_TIME);

        return Error::instance(Constant::$SUCCESS_NUM, ['token' => $token], '新建用户成功');
    }

    /**
     * @param string $token
     * @param array $userInfo
     * @return Error
     * @throws DbException
     * @throws ApiException
     */
    public function completeWxUserInfo(string $token, array $userInfo)
    {
        //到缓存中获取该登录用户的信息
        $loginUser = $this->redis->hGetAll('user_' . $token);
        if (!$loginUser) {
            //万一缓存过期，没有获取到该用户信息的话，返回用户没登录的提示
            return Error::instance(Constant::$USER_NOT_LOGIN);
        }

        if (!array_key_exists('userNo', $loginUser) or empty($loginUser['userNo'])) {
            return Error::instance(Constant::$FAIL_NUM);
        }
        //更新数据库中的用户信息
        //先判断有没有该用户
        $targetUser = $this->userDao->getUserByUserNo($loginUser['userNo']);
        if (!$targetUser) {
            return Error::instance(Constant::$USER_NOT_EXIST);
        }
        //表明数据库中是存在目标用户的，进行更新操作
        $data['avatar']   = array_key_exists('avatarUrl', $userInfo) ? $userInfo['avatarUrl'] : '';
        $data['nickname'] = array_key_exists('nickName', $userInfo) ? $userInfo['nickName'] : '';
        $data['gender']   = array_key_exists('gender', $userInfo) ? $userInfo['gender'] : 0;
        $result           = $this->userDao->update($targetUser['id'], $data);
        if (!$result) {
            return Error::instance(Constant::$USER_WX_INFO_UPDATE_FAIL);
        }

        //更新缓存中的用户信息
        $this->redis->hSet('user_' . $token, 'avatar', $data['avatar']);
        $this->redis->hSet('user_' . $token, 'nickname', $data['nickname']);
        $this->redis->hSet('user_' . $token, 'gender', $data['gender']);

        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
