<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Model\Entity\Admin;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Eloquent\Builder;
use Swoft\Db\Eloquent\Model;
use Swoft\Db\Exception\DbException;

/**
 * Class AdminDao
 * @Bean()
 * @package App\Model\Dao
 */
class AdminDao
{
    /**
     * @param string $account
     * @param string $password
     * @return array|bool
     * @throws DbException
     */
    public function getOne(string $account, string $password)
    {
        $admin = Admin::where('account', '=', $account)
            ->where('password', '=', $password)
            ->first();
        if (!empty($admin)) {
            return $admin->toArray();
        }

        return false;
    }
}
