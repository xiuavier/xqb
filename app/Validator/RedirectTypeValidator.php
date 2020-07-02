<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class RedirectTypeValidator
 *
 * @since 2.0
 *
 * @Validator(name="RedirectTypeValidator")
 */
class RedirectTypeValidator
{
    /**
     * @Required()
     * @IsInt(message="跳转方式值类型错误")
     * @Enum(values={0,1,2,3,4}, message="跳转方式值不在指定范围内")
     */
    protected $type;
}
