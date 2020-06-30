<?php


namespace App\Http\MiniApi\Common;

/**
 * 公共返回状态
 * Class Constant
 * @package App\Http\MiniApi
 */
class Constant
{
    /**
     * @var int 成功代码
     */
    public static $SUCCESS_NUM = 1;
    /**
     * @var int 失败代码
     */
    public static $FAIL_NUM = 0;

    //=============用户登录相关=============
    /**
     * @var int 用户登录token未传递
     */
    public static $USER_TOKEN_REQUIRE = 1001;
    /**
     * @var int 用户未登录
     */
    public static $USER_NOT_LOGIN = 1002;
    /**
     * @var int 用户不存在
     */
    public static $USER_NOT_EXIST = 1003;
    /**
     * @var int 用户微信信息更新失败
     */
    public static $USER_WX_INFO_UPDATE_FAIL = 1004;
    /**
     * @var int 用户微信加密信息解密失败
     */
    public static $USER_WX_INFO_DECRYPTED_FAIL = 1005;

    //=============参数验证================
    /**
     * @var int 参数验证失败
     */
    public static $PARAM_VALIDATE_FAIL = 2001;

    //=============活动相关================
    /**
     * @var int 活动不存在
     */
    public static $ACTIVITY_NOT_EXISTS = 3001;

    //=============广告相关================
    /**
     * @var int 广告列表为空
     */
    public static $ADS_EMPTY = 4001;

    //=============推文相关================
    /**
     * @var int 用户还未发布过推文
     */
    public static $USER_HAS_NOT_POST_ANYTHING = 5001;

    /**
     * @var int 推文列表为空
     */
    public static $POST_LIST_EMPTY = 5002;
}
