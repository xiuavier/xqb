<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TitleNotRequiredValidator
 *
 * @since 2.0
 *
 * @Validator(name="TitleNotRequiredValidator")
 */
class TitleNotRequiredValidator
{
    /**
     * @NotEmpty(message="标题值为空")
     * @IsString(message="标题类型错误")
     */
    protected $title;
}
