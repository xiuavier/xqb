<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TitleValidator
 *
 * @since 2.0
 *
 * @Validator(name="TitleValidator")
 */
class TitleValidator
{
    /**
     * @Required()
     * @NotEmpty(message="标题值为空")
     * @IsString(message="标题类型错误")
     */
    protected $title;
}
