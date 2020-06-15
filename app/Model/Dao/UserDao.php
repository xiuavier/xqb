<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\SnowFlake;
use App\Model\Entity\User;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;
use Swoft\Db\Exception\DbException;

/**
 * Class UserDao
 * @Bean()
 * @package App\Model\Dao
 */
class UserDao
{
    /**
     * 创建新用户
     * @param array $data
     * @return array
     * @throws ApiException
     * @throws DbException
     */
    public function create(array $data)
    {
        $data['user_no'] = (new SnowFlake())->getID();
        //开启事务防止新建过程出问题
        DB::beginTransaction();
        try {
            $user = new User($data);
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        //隐藏id，创建时间，更新时间等字段，不向前端返回
        $user = $user->makeHidden(['id', 'created_at', 'updated_at'])->toArray();
        return $user;
    }

    /**
     * 根据openid来查找是否已有用户注册
     * @param string $openID
     * @return bool|mixed
     * @throws DbException
     */
    public function getUserByOpenID(string $openID)
    {
        $user = User::where('open_id', '=', $openID)
            ->first(['user_no', 'nickname', 'avatar']);
        if (!empty($user)) {
            return $user->toArray();
        }

        return false;
    }

    /**
     * 根据userNo用户编号来查找数据库中是否有该用户
     * @param int $userNo
     * @return array|bool
     * @throws DbException
     */
    public function getUserByUserNo(int $userNo)
    {
        $user = User::where('user_no', '=', $userNo)
            ->first(['id']);
        if (!empty($user)) {
            return $user->toArray();
        }

        return false;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     * @throws ApiException
     */
    public function update(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $result = User::find($id)
                ->fill($data)
                ->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        if ($result) {
            return true;
        }

        return false;
    }
}
