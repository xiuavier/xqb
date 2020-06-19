<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class ActivityIdValidator
 *
 * @since 2.0
 *
 * @Validator(name="ActivityIdValidator")
 */
class ActivityIdValidator
{
    /**
     * @Required()
     * @NotEmpty(message="活动id值为空")
     * @IsInt(message="活动id类型错误")
     */
    protected $activityId;
}
