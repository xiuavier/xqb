<?php


namespace App\Http\Admin\Service;


use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\AdminDao;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Session\HttpSession;
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
        $admin = $this->adminDao->getAccount($data['account']);
        if (!$admin) {
            return Error::instance(Constant::$ADMIN_ACCOUNT_NOT_EXIST);
        }

        if (!password_verify($data['password'], $admin['password'])) {
            return Error::instance(Constant::$ADMIN_PASSWORD_FAIL);
        }

        //将用户信息保存到session中
        $session = HttpSession::current();
        $session->set('adminId', $admin['id']);

        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
