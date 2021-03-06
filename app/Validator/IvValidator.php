<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class IvValidator
 *
 * @since 2.0
 *
 * @Validator(name="IvValidator")
 */
class IvValidator
{
    /**
     * @Required()
     * @NotEmpty(message="iv值为空")
     * @IsString(message="iv类型错误")
     */
    protected $iv;
}
