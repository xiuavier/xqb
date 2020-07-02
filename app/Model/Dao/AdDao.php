<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Model\Entity\Ad;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;
use Swoft\Db\Exception\DbException;

/**
 * Class AdDao
 * @Bean()
 * @package App\Model\Dao
 */
class AdDao
{
    /**
     * @return array|bool
     * @throws DbException
     */
    public function getAds()
    {
        $ads = Ad::where('deleted_at', '=', 0)
            ->orderBy('id', 'desc')
            ->get([
                'id', 'title', 'thumb', 'type', 'activity_id',
                'post_id', 'mini_program_url', 'outside_url'
            ]);
        if ($ads->isEmpty()) {
            return false;
        }
        return $ads->toArray();
    }

    /**
     * @param $data
     * @return bool
     * @throws ApiException
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {
            $ad = new Ad($data);
            $ad->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ApiException('数据库新建广告失败', Constant::$FAIL_NUM);
        }

        return true;
    }
}
