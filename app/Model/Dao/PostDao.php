<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Model\Entity\Post;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;

/**
 * Class PostDao
 * @Bean()
 * @package App\Model\Dao
 */
class PostDao
{
    /**
     * @param array $data
     * @throws ApiException
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
    }
}
