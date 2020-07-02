<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class PublishStatusNotRequiredValidator
 *
 * @since 2.0
 *
 * @Validator(name="PublishStatusNotRequiredValidator")
 */
class PublishStatusNotRequiredValidator
{
    /**
     * @IsInt(message="审核状态值类型错误")
     * @Enum(values={0,1}, message="审核状态值不在指定范围内")
     */
    protected $status;
}
