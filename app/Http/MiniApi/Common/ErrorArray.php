<?php


namespace App\Http\MiniApi\Common;

return [
    Constant::$SUCCESS_NUM                 => "请求成功",
    Constant::$FAIL_NUM                    => "系统异常",
    Constant::$USER_TOKEN_REQUIRE          => "Token未传递",
    Constant::$USER_NOT_LOGIN              => "用户未登录",
    Constant::$PARAM_VALIDATE_FAIL         => "参数验证失败",
    Constant::$USER_NOT_EXIST              => "用户不存在",
    Constant::$USER_WX_INFO_UPDATE_FAIL    => "用户微信信息更新失败",
    Constant::$USER_WX_INFO_DECRYPTED_FAIL => "用户微信信息解密失败",
    Constant::$ACTIVITY_NOT_EXISTS         => "活动不存在",
    Constant::$ADS_EMPTY                   => "广告列表为空",
    Constant::$USER_HAS_NOT_POST_ANYTHING  => "用户还未发布过推文",
    Constant::$POST_LIST_EMPTY             => "推文列表为空",
];
