<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class PublishStatusValidator
 *
 * @since 2.0
 *
 * @Validator(name="PublishStatusValidator")
 */
class PublishStatusValidator
{
    /**
     * @Required()
     * @IsInt(message="发布选项值类型错误")
     * @Enum(values={0,1}, message="发布选项值不在指定范围内")
     */
    protected $status;
}
