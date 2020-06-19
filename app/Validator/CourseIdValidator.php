<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class CourseIdValidator
 *
 * @since 2.0
 *
 * @Validator(name="CourseIdValidator")
 */
class CourseIdValidator
{
    /**
     * @Required()
     * @NotEmpty(message="课程id值为空")
     * @IsInt(message="课程id类型错误")
     */
    protected $courseId;
}
