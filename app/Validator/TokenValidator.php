<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\AlphaNum;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TokenValidator
 *
 * @since 2.0
 *
 * @Validator(name="TokenValidator")
 */
class TokenValidator
{
    /**
     * @Required()
     * @NotEmpty(message="token值为空")
     * @AlphaNum(message="token类型错误，不是字符串")
     * @IsString(message="token类型错误")
     */
    protected $token;
}
