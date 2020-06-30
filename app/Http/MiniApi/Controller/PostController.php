<?php


namespace App\Http\MiniApi\Controller;


use App\Http\Middleware\TokenMiddleware;
use App\Http\MiniApi\Common\ReturnMessage;
use App\Http\MiniApi\Service\PostService;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class PostController
 * @Controller("/MiniApi/Post/")
 * @package App\Http\MiniApi\Controller
 */
class PostController
{
    /**
     * @Inject()
     * @var PostService
     */
    private $postService;

    /**
     * @RequestMapping("lists")
     * @Validate(validator="TokenValidator")
     * @Validate(validator="TypeValidator")
     * @Validate(validator="CurrentPageValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function lists(Request $request)
    {
        $data   = $request->input();
        $result = $this->postService->lists($data);
        return ReturnMessage::success($result);
    }

    /**
     * @RequestMapping("like")
     * @Validate(validator="TokenValidator")
     * @Validate(validator="PostIdValidator")
     * @Middleware(TokenMiddleware::class)
     * @param Request $request
     * @return array
     * @throws DbException
     */
    public function like(Request $request)
    {
        $data   = $request->input();
        $result = $this->postService->like($data);
        return ReturnMessage::success($result);
    }
}
