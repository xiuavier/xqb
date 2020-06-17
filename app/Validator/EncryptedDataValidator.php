<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class EncryptedDataValidator
 *
 * @since 2.0
 *
 * @Validator(name="EncryptedDataValidator")
 */
class EncryptedDataValidator
{
    /**
     * @Required()
     * @NotEmpty(message="encryptedData值为空")
     * @IsString(message="encryptedData类型错误")
     */
    protected $encryptedData;
}
