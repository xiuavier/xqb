<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsArray;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class UserInfoValidator
 *
 * @since 2.0
 *
 * @Validator(name="UserInfoValidator")
 */
class UserInfoValidator
{
    /**
     * @Required()
     * @NotEmpty(message="用户微信信息为空")
     * @IsArray(message="用户微信信息类型错误，不是数组")
     */
    protected $userInfo;
}
