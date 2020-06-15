<?php


namespace App\Http\MiniApi\Common;

/**
 * Class SnowFlake
 * @package App\Http\MiniApi\Common
 */
class SnowFlake
{
    /**
     * 起止时间戳，毫秒
     */
    const EPOCH = 1543223810238;
    /**
     * 序号部分  1位，因为考虑到可能没有呢么多用户
     */
    const SEQUENCE_BITS = 1;
    /**
     * 序号最大值
     */
    const SEQUENCE_MAX = -1 ^ (-1 << self::SEQUENCE_BITS);
    /**
     * 节点部分1位
     */
    const WORKER_BITS = 1;
    /**
     * 节点最大数值
     */
    const WORKER_MAX = -1 ^ (-1 << self::WORKER_BITS);
    /**
     * 时间戳部分左偏移量
     */
    const TIME_SHIFT = self::WORKER_BITS + self::SEQUENCE_BITS;
    /**
     * 节点部分左偏移量
     */
    const WORKER_SHIFT = self::SEQUENCE_BITS;
    /**
     * 上次ID生成的时间戳
     * @var
     */
    protected $timestamp;
    /**
     * 节点ID
     * @var
     */
    protected $workerID = 1;
    /**
     * 序号
     * @var
     */
    protected $sequence;
    /**
     * swoole互斥锁
     * @var
     */
    protected $lock;

    public function __construct()
    {
        $this->timestamp = 0;
        $this->sequence  = 0;
        $this->lock      = new \swoole_lock(SWOOLE_MUTEX);
    }

    /**
     * 生成ID
     */
    public function getID()
    {
        //加锁
        $this->lock->lock();
        $now = $this->now();

        if ($this->timestamp == $now) {
            $this->sequence++;

            if ($this->sequence > self::SEQUENCE_MAX) {
                // 当前毫秒内生成的序号已经超出最大范围，等待下一毫秒重新生成
                while ($now <= $this->timestamp) {
                    $now = $this->now();
                }
            }
        } else {
            $this->sequence = 0;
        }

        $this->timestamp = $now;    // 更新ID生时间戳

        $id = (($now - self::EPOCH) << self::TIME_SHIFT) | ($this->workerID << self::WORKER_SHIFT) | $this->sequence;
        $this->lock->unlock();  //解锁

        return $id;
    }

    /**
     * 获取当前毫秒
     * @return string
     */
    public function now()
    {
        return sprintf("%.0f", microtime(true) * 1000);
    }
}
