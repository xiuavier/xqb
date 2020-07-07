<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class NicknameNotRequiredValidator
 *
 * @since 2.0
 *
 * @Validator(name="NicknameNotRequiredValidator")
 */
class NicknameNotRequiredValidator
{
    /**
     * @NotEmpty(message="昵称值为空")
     * @IsString(message="昵称类型错误")
     */
    protected $nickname;
}
