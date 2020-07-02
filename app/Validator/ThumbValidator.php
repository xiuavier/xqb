<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class ThumbValidator
 *
 * @since 2.0
 *
 * @Validator(name="ThumbValidator")
 */
class ThumbValidator
{
    /**
     * @Required()
     * @NotEmpty(message="缩略图值为空")
     * @IsString(message="缩略图类型错误")
     */
    protected $thumb;
}
