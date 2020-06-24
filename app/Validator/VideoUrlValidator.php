<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class VideoUrlValidator
 *
 * @since 2.0
 *
 * @Validator(name="VideoUrlValidator")
 */
class VideoUrlValidator
{
    /**
     * @Required()
     * @NotEmpty(message="视频地址值为空")
     * @IsString(message="视频地址类型错误")
     */
    protected $videoUrl;
}
