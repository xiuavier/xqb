<?php


namespace App\Http\MiniApi\Common;

/**
 * 数据库表中的一些字段的常量值
 * Class Constant
 * @package App\Http\MiniApi
 */
class DatabaseCode
{
    /**
     * @var int 推文表type字段表示视频
     */
    public static $POST_TYPE_VIDEO = 0;
    /**
     * @var int 推文表type字段表示图片
     */
    public static $POST_TYPE_PICTURE = 1;

    /**
     * @var int 等待审核状态
     */
    public static $REVIEW_STATUS_WAIT = 0;
    /**
     * @var int 通过审核
     */
    public static $REVIEW_STATUS_PASS = 1;
    /**
     * @var int 审核失败或撤销审核
     */
    public static $REVIEW_STATUS_FAIL = 2;
}
