<?php


namespace App\Http\MiniApi\Common;


class ReturnMessage
{
    public static function success(Error $error)
    {
        return [
            'code' => $error->getCode(),
            'msg'  => $error->getMsg(),
            'data' => $error->getData(),
        ];
    }
}
