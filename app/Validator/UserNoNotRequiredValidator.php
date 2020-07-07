<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class UserNoNotRequiredValidator
 *
 * @since 2.0
 *
 * @Validator(name="UserNoNotRequiredValidator")
 */
class UserNoNotRequiredValidator
{
    /**
     * @NotEmpty(message="用户编号值为空")
     * @IsInt(message="用户编号类型错误")
     */
    protected $userNo;
}
