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
    /**
     * @var int 广告点击后跳转到活动
     */
    public static $AD_GOTO_ACTIVITY = 0;
    /**
     * @var int 广告点击后跳转到视频
     */
    public static $AD_GOTO_VIDEO = 1;
    /**
     * @var int 广告点击后跳转到图文
     */
    public static $AD_GOTO_PICTURE = 2;
    /**
     * @var int 广告点击后跳转到小程序
     */
    public static $AD_GOTO_MINI_PROGRAM = 3;
    /**
     * @var int 广告点击后跳转到外链
     */
    public static $AD_GOTO_OUTSIDE_CHAIN = 4;
    /**
     * @var int 小程序前端，活动每页数量
     */
    public static $ACTIVITY_PER_PAGE = 5;

    /**
     * @var int 快乐活动
     */
    public static $ACTIVITY_TYPE_HAPPY = 0;

    /**
     * @var int 安全活动
     */
    public static $ACTIVITY_TYPE_SAFE = 1;

    /**
     * @var int 推文每页数量
     */
    public static $POST_PER_PAGE = 10;

    /**
     * @var int 广告管理每页数量
     */
    public static $AD_PER_PAGE = 10;
}
