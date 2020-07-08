<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class FilePathValidator
 *
 * @since 2.0
 *
 * @Validator(name="FilePathValidator")
 */
class FilePathValidator
{
    /**
     * @Required()
     * @NotEmpty(message="文件路径值为空")
     * @IsString(message="文件路径类型错误")
     */
    protected $filePath;
}
