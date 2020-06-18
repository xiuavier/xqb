<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\AlphaNum;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class VideoPathValidator
 *
 * @since 2.0
 *
 * @Validator(name="VideoPathValidator")
 */
class VideoPathValidator
{
    /**
     * @Required()
     * @NotEmpty(message="videoPath值为空")
     * @IsString(message="videoPath类型错误，不是字符串")
     */
    protected $videoPath;
}
