<?php


namespace App\Http\MiniApi\Service;

use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\AdDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Redis\Pool;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class AdService
 * @Service()
 * @package App\Http\MiniApi\Service
 */
class AdService
{
    /**
     * @Inject()
     * @var Pool
     */
    private $redis;
    /**
     * @Inject()
     * @var AdDao
     */
    private $adDao;

    /**
     * @return Error
     * @throws DbException
     */
    public function lists()
    {
        $lists = $this->adDao->getAds();
        if (!$lists) {
            return Error::instance(Constant::$ADS_EMPTY);
        }

        return Error::instance(Constant::$SUCCESS_NUM, $lists);
    }
}
