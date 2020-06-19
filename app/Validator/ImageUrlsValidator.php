<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsArray;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class ImageUrlsValidator
 *
 * @since 2.0
 *
 * @Validator(name="ImageUrlsValidator")
 */
class ImageUrlsValidator
{
    /**
     * @Required()
     * @NotEmpty(message="图片链接参数值为空")
     * @IsArray(message="图片链接参数类型错误")
     */
    protected $imageUrls;
}
