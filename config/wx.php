<?php
return [
    'appID'           => 'wxe1289ed51e02f67c',
    'appSecret'       => '4727072f5be2b29fbe7cf1f930791b3a',
    'wxAuthUrl'       => 'https://api.weixin.qq.com/sns/jscode2session?' .
        'appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
    'token_salt'      => 'WrNWVt6RHG',
    'token_expire_in' => 60 * 60 * 24 * 7,
];
