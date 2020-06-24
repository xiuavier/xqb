<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
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
}
