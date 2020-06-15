<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\AlphaNum;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class CodeValidator
 *
 * @since 2.0
 *
 * @Validator(name="CodeValidator")
 */
class CodeValidator
{
    /**
     * @Required()
     * @NotEmpty(message="code值为空")
     * @AlphaNum(message="code类型错误，不是字符串")
     * @IsString()
     */
    protected $code;
}
