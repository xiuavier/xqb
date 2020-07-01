<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class AccountValidator
 *
 * @since 2.0
 *
 * @Validator(name="AccountValidator")
 */
class AccountValidator
{
    /**
     * @Required()
     * @NotEmpty(message="账号名称值为空")
     * @IsString(message="账号类型错误")
     */
    protected $account;
}
