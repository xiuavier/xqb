<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 推文表，记录用户发布的所有图文和视频
 * Class Post
 *
 * @since 2.0
 *
 * @Entity(table="post")
 */
class Post extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 
     *
     * @Column()
     *
     * @var string|null
     */
    private $title;

    /**
     * 参与的活动标签
     *
     * @Column()
     *
     * @var string|null
     */
    private $tag;

    /**
     * 所属的用户id
     *
     * @Column(name="user_id", prop="userId")
     *
     * @var int|null
     */
    private $userId;

    /**
     * 所属的活动id
     *
     * @Column(name="activity_id", prop="activityId")
     *
     * @var int|null
     */
    private $activityId;

    /**
     * 推文的活动类型，0表示快乐成长，1表示安全成长
     *
     * @Column(name="activity_type", prop="activityType")
     *
     * @var int|null
     */
    private $activityType;

    /**
     * 课程id
     *
     * @Column(name="course_id", prop="courseId")
     *
     * @var int|null
     */
    private $courseId;

    /**
     * 推文类型，0表示视频，1表示图文
     *
     * @Column()
     *
     * @var int|null
     */
    private $type;

    /**
     * 推文获赞数
     *
     * @Column()
     *
     * @var int|null
     */
    private $likes;

    /**
     * 审核状态，0表示未审核，1表示审核通过，2表示撤销审核
     *
     * @Column(name="review_status", prop="reviewStatus")
     *
     * @var int|null
     */
    private $reviewStatus;

    /**
     * 
     *
     * @Column(name="created_at", prop="createdAt")
     *
     * @var int|null
     */
    private $createdAt;

    /**
     * 
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var int|null
     */
    private $updatedAt;

    /**
     * 
     *
     * @Column(name="deleted_at", prop="deletedAt")
     *
     * @var int|null
     */
    private $deletedAt;


    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string|null $title
     *
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string|null $tag
     *
     * @return self
     */
    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @param int|null $userId
     *
     * @return self
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param int|null $activityId
     *
     * @return self
     */
    public function setActivityId(?int $activityId): self
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * @param int|null $activityType
     *
     * @return self
     */
    public function setActivityType(?int $activityType): self
    {
        $this->activityType = $activityType;

        return $this;
    }

    /**
     * @param int|null $courseId
     *
     * @return self
     */
    public function setCourseId(?int $courseId): self
    {
        $this->courseId = $courseId;

        return $this;
    }

    /**
     * @param int|null $type
     *
     * @return self
     */
    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int|null $likes
     *
     * @return self
     */
    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @param int|null $reviewStatus
     *
     * @return self
     */
    public function setReviewStatus(?int $reviewStatus): self
    {
        $this->reviewStatus = $reviewStatus;

        return $this;
    }

    /**
     * @param int|null $createdAt
     *
     * @return self
     */
    public function setCreatedAt(?int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param int|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(?int $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param int|null $deletedAt
     *
     * @return self
     */
    public function setDeletedAt(?int $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return int|null
     */
    public function getActivityId(): ?int
    {
        return $this->activityId;
    }

    /**
     * @return int|null
     */
    public function getActivityType(): ?int
    {
        return $this->activityType;
    }

    /**
     * @return int|null
     */
    public function getCourseId(): ?int
    {
        return $this->courseId;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getLikes(): ?int
    {
        return $this->likes;
    }

    /**
     * @return int|null
     */
    public function getReviewStatus(): ?int
    {
        return $this->reviewStatus;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    /**
     * @return int|null
     */
    public function getDeletedAt(): ?int
    {
        return $this->deletedAt;
    }

}
