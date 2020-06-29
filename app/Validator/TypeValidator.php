<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TypeValidator
 *
 * @since 2.0
 *
 * @Validator(name="TypeValidator")
 */
class TypeValidator
{
    /**
     * @Required()
     * @NotEmpty(message="活动类型值为空")
     * @IsInt(message="活动类型值类型错误")
     * @Enum(values={0,1,2}, message="活动类型值不在指定范围内")
     */
    protected $type;
}