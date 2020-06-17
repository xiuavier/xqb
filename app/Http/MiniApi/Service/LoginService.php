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
        $openId     = $wxResult['openid'];
        $sessionKey = $wxResult['session_key'];

        $originSessionKey = $this->redis->get('openId:' . $openId . ':sessionKey');
        if ($originSessionKey) {
            //说明缓存中已经保存过该微信用户的sessionKey
            //sessionKey是会变的，要做好更新的操作
            //还是对比下sessionKey吧，要不直接删除感觉不是很好
            if ($originSessionKey != $sessionKey) {
                //不相等的话，更新
                $this->redis->set(
                    'openId:' . $openId . ':sessionKey', $sessionKey,
                    Wx::$EXPIRE_TIME
                );
            }
        } else {
            //在缓存中保存对应openid的微信用户的sessionKey，并且设置过期时间
            $this->redis->set(
                'openId:' . $openId . ':sessionKey', $sessionKey,
                Wx::$EXPIRE_TIME
            );
        }

        //需要判断下该openId的微信用户是否注册过
        $hasRegistered = $this->userDao->getUserByOpenID($openId);
        if ($hasRegistered) {
            //表明该openid已有用户注册，即该微信用户之前已经登陆过兴趣帮小程序
            //需要先看一下该注册用户是否已经有了token在缓存中，
            //如果有了的话，直接返回该token就可以，没有的话再生成新的返回
            $originToken = $this->redis->get('openId:' . $openId . ':token');
            if ($originToken) {
                //说明用户之前生成的token未过期，直接返回
                return Error::instance(Constant::$SUCCESS_NUM, ['token' => $originToken], '用户Token未过期');
            }
            //用户之前生成的token已过期，重新生成新的token
            //并且存储到缓存中，使用openId跟他建立关系
            $this->redis->set('openId:' . $openId . ':token', $token, Wx::$EXPIRE_TIME);
            foreach ($hasRegistered as $key => $value) {
                //key添加上用户的编号
                $this->redis->hSet('token:' . $token, $key, $value);
            }
            $this->redis->expire('token:' . $token, Wx::$EXPIRE_TIME);
            return Error::instance(Constant::$SUCCESS_NUM, ['token' => $token], '用户已注册');
        }

        //表明该微信用户之前没有登陆过兴趣帮小程序，则新建用户
        $res = $this->userDao->create(['open_id' => $openId]);
        if (!$res) {
            return Error::instance(Constant::$FAIL_NUM, '', '新建用户失败');
        }
        foreach ($res as $k => $v) {
            $this->redis->hSet('token:' . $token, $k, $v);
        }
        //设置用户缓存过期时间
        $this->redis->expire('token:' . $token, Wx::$EXPIRE_TIME);
        $beforeToken = $this->redis->get('openId:' . $openId . ':token');
        if ($beforeToken) {
            $this->redis->del('token:' . $beforeToken);
        }
        $this->redis->set('openId:' . $openId . ':token', $token, Wx::$EXPIRE_TIME);

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
        $loginUser = $this->redis->hGetAll('token:' . $token);
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
        $this->redis->hSet('token:' . $token, 'avatar', $data['avatar']);
        $this->redis->hSet('token:' . $token, 'nickname', $data['nickname']);
        $this->redis->hSet('token:' . $token, 'gender', $data['gender']);

        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
