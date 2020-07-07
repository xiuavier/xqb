<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Exception\ApiException;
use App\Http\MiniApi\Common\Constant;
use App\Model\Entity\Course;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;

/**
 * Class CourseDao
 * @Bean()
 * @package App\Model\Dao
 */
class CourseDao
{
    /**
     * @param array $data
     * @return array
     * @throws ApiException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $course = new Course($data);
            $course->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ApiException('', Constant::$FAIL_NUM);
        }

        return $course->toArray();
    }
}
