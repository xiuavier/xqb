<?php


namespace App\Http\MiniApi\Controller;


use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\AdService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class AdController
 * @Controller("/MiniApi/Ad/")
 * @package App\Http\MiniApi\Controller
 */
class AdController
{
    /**
     * @Inject()
     
     * @var AdService
     */
    private $adService;

    /**
     * @RequestMapping("lists")
     * @Validate(validator="TokenValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function lists(Request $request)
    {
        $result = $this->adService->lists();
        return ReturnMessage::success($result);
    }
}
