<?php


namespace App\Http\Admin\Service;


use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\AdminDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class LoginService
 * @Service()
 * @package App\Http\Admin\Service
 */
class LoginService
{
    /**
     * @Inject()
     * @var AdminDao
     */
    private $adminDao;

    /**
     * @param array $data
     * @return Error
     * @throws DbException
     */
    public function login(array $data)
    {
        $admin = $this->adminDao->getOne($data['account'], $data['password']);
        if (!$admin) {
            return Error::instance(Constant::$ADMIN_LOGIN_FAIL);
        }
        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
