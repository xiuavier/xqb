<?php


namespace App\Http\MiniApi\Service;

use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\ActivityDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class ActivityService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class ActivityService
{
    /**
     * @Inject()
     * @var Pool
     */
    private $redis;
    /**
     * @Inject()
     * @var ActivityDao
     */
    private $activityDao;

    /**
     * @param array $data
     * @return Error
     * @throws DbException
     */
    public function lists(array $data)
    {
        if ($data['type'] == 0) {
            $lists = $this->activityDao->getAll(
                $data['currentPage'],
                DatabaseCode::$ACTIVITY_PER_PAGE
            );
        } else {
            $lists = $this->activityDao->getMany(
                $data['currentPage'],
                DatabaseCode::$ACTIVITY_PER_PAGE,
                $data['type'] - 1
            );
        }

        if (!$lists) {
            return Error::instance(Constant::$FAIL_NUM);
        }
        return Error::instance(Constant::$SUCCESS_NUM, $lists);
    }
}
