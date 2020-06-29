<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Model\Entity\Activity;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Exception\DbException;

/**
 * Class ActivityDao
 * @Bean()
 * @package App\Model\Dao
 */
class ActivityDao
{
    /**
     * 获取一条活动的信息
     * @param int $id
     * @return array|bool
     * @throws DbException
     */
    public function getOne(int $id)
    {
        $activity = Activity::where('id', '=', $id)
            ->first(['id', 'title', 'tag', 'slogan', 'thumb_url', 'rule_url', 'bg_url']);
        if (!empty($activity)) {
            return $activity->toArray();
        }

        return false;
    }

    /**
     * @param int $currentPage 当前页数
     * @param int $pageSize 每页数量
     * @return array|bool
     */
    public function getAll(int $currentPage, int $pageSize)
    {
        $activities = Activity::where('deleted_at', '=', 0)
            ->paginate($currentPage, $pageSize);
        if (!empty($activities)) {
            return $activities;
        }

        return false;
    }

    /**
     * @param int $currentPage
     * @param int $pageSize
     * @param int $type
     * @return array|bool
     * @throws DbException
     */
    public function getMany(int $currentPage, int $pageSize, int $type)
    {
        $activities = Activity::where('deleted_at', '=', 0)
            ->where('type', '=', $type)
            ->paginate($currentPage, $pageSize);
        if (!empty($activities)) {
            return $activities;
        }

        return false;
    }
}
