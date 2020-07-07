<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class DifficultyValidator
 *
 * @since 2.0
 *
 * @Validator(name="DifficultyValidator")
 */
class DifficultyValidator
{
    /**
     * @Required()
     * @IsInt(message="难度值类型错误")
     * @Enum(values={1,2,3,4,5}, message="难度值不在指定范围内")
     */
    protected $difficulty;
}
