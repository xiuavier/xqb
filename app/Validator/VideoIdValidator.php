<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class VideoIdValidator
 *
 * @since 2.0
 *
 * @Validator(name="VideoIdValidator")
 */
class VideoIdValidator
{
    /**
     * @Required()
     * @NotEmpty(message="视频ID值为空")
     * @IsString(message="视频ID类型错误")
     */
    protected $videoId;
}
