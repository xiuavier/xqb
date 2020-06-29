<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class CurrentPageValidator
 *
 * @since 2.0
 *
 * @Validator(name="CurrentPageValidator")
 */
class CurrentPageValidator
{
    /**
     * @Required()
     * @NotEmpty(message="当前页数值为空")
     * @IsInt(message="当前页数类型错误")
     */
    protected $currentPage;
}
