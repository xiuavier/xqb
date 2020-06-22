<?php


namespace App\Http\MiniApi\Common;


class Wx
{
    public static $EXPIRE_TIME = 60 * 60 * 24 * 7;
    private $wxAppID = 'wxe1289ed51e02f67c';
    private $wxAppSecret = '99875488bbd8408d3409075edeb90199';
    private $wxLoginUrl = 'https://api.weixin.qq.com/sns/jscode2session?' .
    'appid=%s&secret=%s&js_code=%s&grant_type=authorization_code';

    /**
     * @param $code
     * @return string
     */
    public function getWxLoginUrl($code)
    {
        return sprintf($this->wxLoginUrl, $this->wxAppID, $this->wxAppSecret, $code);
    }
}
