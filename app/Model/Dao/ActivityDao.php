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
}
