<?php


namespace App\Http\Admin\Service;


use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Http\MiniApi\Common\DatabaseCode;
use App\Http\MiniApi\Common\Error;
use App\Model\Dao\CourseDao;
use App\Model\Entity\Course;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Exception\DbException;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class CourseService
 * @Service()
 * @package App\Http\Admin\Service
 */
class CourseService
{
    /**
     * @Inject()
     * @var CourseDao
     */
    private $courseDao;

    /**
     * @param array $data
     * @return Error
     * @throws ApiException
     * @throws DbException
     */
    public function create(array $data)
    {
        $courseData                = [];
        $courseData['title']       = $data['title'];
        $courseData['type']        = $data['tag'];
        $courseData['thumb_url']   = $data['thumb'];
        $courseData['video_url']   = $data['videoPath'];
        $courseData['attend_type'] = $data['attendType'];
        $courseData['difficulty']  = $data['difficulty'];
        $courseData['description'] = $data['description'];
        $this->courseDao->create($courseData);
        return Error::instance(Constant::$SUCCESS_NUM);
    }

    /**
     * @param array $data
     * @return Error
     * @throws DbException
     */
    public function list(array $data)
    {
        $query = Course::query();
        if (array_key_exists('title', $data)) {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (array_key_exists('tag', $data)) {
            $query = $query->where('tag', 'like', '%' . $data['tag'] . '%');
        }

        $lists = $query->select(
            'id', 'title', 'tag', 'thumb_url', 'video_url',
            'attend_type', 'difficulty', 'status', 'description'
        )
            ->where('deleted_at', '=', 0)
            ->orderByDesc('id')
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
