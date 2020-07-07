<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class AttendTypeValidator
 *
 * @since 2.0
 *
 * @Validator(name="AttendTypeValidator")
 */
class AttendTypeValidator
{
    /**
     * @Required()
     * @IsInt(message="参与方式类型错误")
     * @Enum(values={0,1}, message="参与方式值不在指定范围内")
     */
    protected $attendType;
}
