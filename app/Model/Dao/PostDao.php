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
     * @throws ApiException
     */
    public function reviewPass(int $postId)
    {
        DB::beginTransaction();
        try {
            $post = Post::find($postId);
            $post->update([
                'review_status' => DatabaseCode::$REVIEW_STATUS_PASS
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return true;
    }

    /**
     * 推文审核失败
     * @param int $postId
     * @return bool
     * @throws DbException
     * @throws ApiException
     */
    public function reviewFail(int $postId)
    {
        DB::beginTransaction();
        try {
            $post = Post::find($postId);
            $post->update([
                'review_status' => DatabaseCode::$REVIEW_STATUS_FAIL
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return true;
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

    /**
     * @param int $type
     * @param int $currentPage
     * @return array|bool
     * @throws DbException
     */
    public function getPostsByType(int $type, int $currentPage)
    {
        $posts = Post::select(
            'id', 'title', 'tag', 'activity_id', 'user_id',
            'activity_type', 'course_id', 'type', 'likes'
        )
            ->where('activity_type', '=', $type)
            ->where('deleted_at', '=', 0)
            ->where('review_status', '=', DatabaseCode::$REVIEW_STATUS_PASS)
            ->paginate($currentPage, DatabaseCode::$POST_PER_PAGE);

        if (empty($posts['list'])) {
            return false;
        }
        return $posts;
    }

    /**
     * @param int $currentPage
     * @return array|bool
     * @throws DbException
     */
    public function getAllPosts(int $currentPage)
    {
        $posts = Post::select(
            'id', 'title', 'tag', 'activity_id', 'user_id',
            'activity_type', 'course_id', 'type', 'likes'
        )
            ->where('deleted_at', '=', 0)
            ->where('review_status', '=', DatabaseCode::$REVIEW_STATUS_PASS)
            ->paginate($currentPage, DatabaseCode::$POST_PER_PAGE);

        if (empty($posts['list'])) {
            return false;
        }
        return $posts;
    }

    /**
     * 增加动态点赞数
     * @param int $postId
     * @return bool
     * @throws ApiException
     */
    public function addLikes(int $postId)
    {
        DB::beginTransaction();
        try {
            Post::find($postId)
                ->increment('likes', 1);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return true;
    }

    /**
     * 减少动态点赞数
     * @param int $postId
     * @return bool
     * @throws ApiException
     */
    public function descLikes(int $postId)
    {
        DB::beginTransaction();
        try {
            Post::find($postId)
                ->decrement('likes', 1);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return true;
    }
}
