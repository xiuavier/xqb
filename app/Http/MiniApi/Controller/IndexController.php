<?php


namespace App\Http\MiniApi\Controller;


use App\Exception\ApiException;
use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\LoginService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class IndexController
 * @Controller("/MiniApi/Login/")
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
