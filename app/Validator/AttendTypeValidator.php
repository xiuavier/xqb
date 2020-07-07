<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
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
     * @NotEmpty(message="参与方式值为空")
     * @IsInt(message="参与方式类型错误")
     */
    protected $attendType;
}
