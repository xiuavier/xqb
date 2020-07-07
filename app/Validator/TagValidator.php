<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TagValidator
 *
 * @since 2.0
 *
 * @Validator(name="TagValidator")
 */
class TagValidator
{
    /**
     * @Required()
     * @NotEmpty(message="标签值为空")
     * @IsString(message="标签类型错误")
     */
    protected $tag;
}
