<?php


namespace App\Http\Admin\Service;


use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\UserDao;
use App\Model\Entity\User;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class UserService
 * @Service()
 * @package App\Http\Admin\Service
 */
class UserService
{
    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    /**
     * @param array $data
     * @return Error
     * @throws DbException
     */
    public function list(array $data)
    {
        $query = User::query();
        if (array_key_exists('userNo', $data)) {
            $query = $query->where('user_no', '=', $data['userNo']);
        }
        if (array_key_exists('nickname', $data)) {
            $query = $query->where('nickname', 'like', '%' . $data['nickname'] . '%');
        }
        if (array_key_exists('createStart', $data) and array_key_exists('createEnd', $data)) {
            $query = $query->whereBetween('created_at', [$data['createStart'], $data['createEnd']]);
        }

        $lists = $query->select('id, user_no, nickname, avatar, gender, created_at')
            ->orderByDesc('id')
            ->paginate($data['currentPage'], DatabaseCode::$AD_PER_PAGE);
        return Error::instance(Constant::$SUCCESS_NUM, $lists);
    }
}
