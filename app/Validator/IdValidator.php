<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class IdValidator
 *
 * @since 2.0
 *
 * @Validator(name="IdValidator")
 */
class IdValidator
{
    /**
     * @Required()
     * @NotEmpty(message="id值为空")
     * @IsInt(message="id类型错误")
     */
    protected $id;
}
