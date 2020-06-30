<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Model\Entity\Post;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;
use Swoft\Db\Exception\DbException;

/**
 * Class PostDao
 * @Bean()
 * @package App\Model\Dao
 */
class PostDao
{
    /**
     * @param array $data
     * @return array
     * @throws ApiException
     * @throws DbException
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $post = new Post($data);
            $post->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return $post->toArray();
    }

    /**
     * 推文审核通过
     * @param int $postId
     * @return bool
     * @throws DbException
     */
    public function reviewPass(int $postId)
    {
        $post   = Post::find($postId);
        $result = $post->update([
            'review_status' => DatabaseCode::$REVIEW_STATUS_PASS
        ]);

        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * 推文审核失败
     * @param int $postId
     * @return bool
     * @throws DbException
     */
    public function reviewFail(int $postId)
    {
        $post   = Post::find($postId);
        $result = $post->update([
            'review_status' => DatabaseCode::$REVIEW_STATUS_FAIL
        ]);

        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * @param int $userId
     * @param int $currentPage
     * @return array|bool
     * @throws DbException
     */
    public function getUserPostsByUserNo(int $userId, int $currentPage)
    {
        $posts = Post::select(
            'id', 'title', 'tag', 'activity_id',
            'activity_type', 'course_id', 'type', 'likes'
        )
            ->where('user_id', '=', $userId)
            ->where('deleted_at', '=', 0)
            ->where('review_status', '=', DatabaseCode::$REVIEW_STATUS_PASS)
            ->paginate($currentPage, DatabaseCode::$ACTIVITY_PER_PAGE);

        if (empty($posts['list'])) {
            return false;
        }
        return $posts;
    }
}
