<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class PostIdValidator
 *
 * @since 2.0
 *
 * @Validator(name="PostIdValidator")
 */
class PostIdValidator
{
    /**
     * @Required()
     * @NotEmpty(message="推文ID值为空")
     * @IsInt(message="推文ID类型错误")
     */
    protected $postId;
}
