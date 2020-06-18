<?php declare(strict_types=1);
/**
 * 一些常用的公共方法会放在这里
 */

define('accessKeyId', 'LTAIUSDM3yodhBRD');
define('accessKeySecret', 'sZioo1TcjPkdiKxT93mOys3yaFV14f');
define('VOD_CLIENT_NAME', 'xqbVodServer');

/**
 * @param $url
 * @param int $httpCode
 * @return bool|string
 */
function curl_get($url, &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //不做证书校验，部署在Linux环境下请改为true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file_contents = curl_exec($ch);
    $httpCode      = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $file_contents;
}

/**
 * @param $url
 * @param $requestData
 * @param int $httpCode
 * @return bool|string
 */
function curl_post($url, $requestData, &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

    $file_contents = curl_exec($ch);
    $httpCode      = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $file_contents;
}

/**
 * 获取随机字符串
 * @param $length
 * @return string
 */
function getRandChars($length)
{
    $str    = '';
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max    = strlen($strPol) - 1;

    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}

/**
 * 生成微信token
 * @return string
 */
function generateWxToken()
{
    $randChars = getRandChars(32);
    $time      = time();
    return md5($randChars . $time);
}

function decryptData($encryptedData, $iv, $sessionKey)
{
    if (strlen($sessionKey) != 24) {
        return false;
    }
    $aesKey = base64_decode($sessionKey);

    if (strlen($iv) != 24) {
        return false;
    }
    $aesIV = base64_decode($iv);

    $aesCipher = base64_decode($encryptedData);

    $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
    if (!$result) {
        return false;
    }

    $data = json_decode($result, true);
    if (empty($data)) {
        return false;
    }
    if ($data['watermark']['appid'] != 'wxe1289ed51e02f67c') {
        return false;
    }

    return $data;
}
