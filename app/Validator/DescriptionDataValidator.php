<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class DescriptionDataValidator
 *
 * @since 2.0
 *
 * @Validator(name="DescriptionDataValidator")
 */
class DescriptionDataValidator
{
    /**
     * @Required()
     * @NotEmpty(message="介绍值为空")
     * @IsString(message="介绍类型错误")
     */
    protected $description;
}
