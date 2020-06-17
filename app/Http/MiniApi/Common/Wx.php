<?php


namespace App\Http\MiniApi\Common;


class Wx
{
    public static $EXPIRE_TIME = 60 * 60 * 24 * 7;
    private $wxAppID = 'wxe1289ed51e02f67c';
    private $wxAppSecret = '4727072f5be2b29fbe7cf1f930791b3a';
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
