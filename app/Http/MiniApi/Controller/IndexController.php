<?php


namespace App\Http\MiniApi\Controller;


use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class IndexController
 * @Controller()
 * @package App\Http\MiniApi\Controller
 */
class IndexController
{
    /**
     * @RequestMapping("/")
     * @return string
     */
    public function index()
    {
        return "这里是首页";
    }
}
