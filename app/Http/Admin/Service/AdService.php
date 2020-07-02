<?php


namespace App\Http\Admin\Service;


use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\AdDao;
use App\Model\Entity\Ad;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class AdService
 * @Service()
 * @package App\Http\Admin\Service
 */
class AdService
{
    /**
     * @Inject()
     * @var AdDao
     */
    private $adDao;

    /**
     * @param array $data
     * @return Error
     * @throws ApiException
     */
    public function create(array $data)
    {
        $adData = [];
        if ($data['type'] == 0) {
            if (!array_key_exists('activityId', $data) or empty($data['activityId'])) {
                return Error::instance(Constant::$ACTIVITY_ID_NOT_EXISTS);
            }
            $adData['activity_id'] = $data['activityId'];
        } elseif ($data['type'] == 1) {
            if (!array_key_exists('postId', $data) or empty($data['postId'])) {
                return Error::instance(Constant::$POST_ID_NOT_EXIST);
            }
            $adData['post_id'] = $data['post_id'];
        } elseif ($data['type'] == 2) {
            if (!array_key_exists('postId', $data) or empty($data['postId'])) {
                return Error::instance(Constant::$POST_ID_NOT_EXIST);
            }
            $adData['post_id'] = $data['post_id'];
        } elseif ($data['type'] == 3) {
            if (!array_key_exists('miniProgramUrl', $data) or empty($data['miniProgramUrl'])) {
                return Error::instance(Constant::$MINI_PROGRAM_URL_NOT_EXIST);
            }
            $adData['mini_program_url'] = $data['mini_program_url'];
        } else {
            if (!array_key_exists('outsideUrl', $data) or empty($data['outsideUrl'])) {
                return Error::instance(Constant::$POST_ID_NOT_EXIST);
            }
            $adData['outside_url'] = $data['outside_url'];
        }

        $adData['title']  = $data['title'];
        $adData['type']   = $data['type'];
        $adData['thumb']  = $data['thumb'];
        $adData['status'] = $data['status'];
        $this->adDao->create($adData);
        return Error::instance(Constant::$SUCCESS_NUM);
    }

    /**
     * @param array $data
     * @return Error
     * @throws DbException
     */
    public function list(array $data)
    {
        $query = Ad::query();
        if (array_key_exists('title', $data)) {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }

        if (array_key_exists('status', $data)) {
            $query = $query->where('status', '=', $data['status']);
        }

        if (array_key_exists('updateTimeStart', $data) and array_key_exists('updateTimeEnd', $data)) {
            $query = $query->whereBetween('updated_at', [$data['updateTimeStart'], $data['updateTimeEnd']]);
        }

        $lists = $query->orderByDesc('id')
            ->paginate($data['currentPage'], DatabaseCode::$AD_PER_PAGE);
        return Error::instance(Constant::$SUCCESS_NUM, $lists);
    }

    /**
     * @param array $data
     * @return Error
     * @throws ApiException
     */
    public function update(array $data)
    {
        $this->adDao->update($data);
        return Error::instance(Constant::$SUCCESS_NUM);
    }
}
