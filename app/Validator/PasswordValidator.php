<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class PasswordValidator
 *
 * @since 2.0
 *
 * @Validator(name="PasswordValidator")
 */
class PasswordValidator
{
    /**
     * @Required()
     * @NotEmpty(message="密码值为空")
     * @IsString(message="密码类型错误")
     */
    protected $password;
}
