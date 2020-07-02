<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 广告表
 * Class Ad
 *
 * @since 2.0
 *
 * @Entity(table="ad")
 */
class Ad extends Model
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
     * 标题
     *
     * @Column()
     *
     * @var string|null
     */
    private $title;

    /**
     * 缩略图
     *
     * @Column()
     *
     * @var string|null
     */
    private $thumb;

    /**
     * 跳转方式，0表示跳转到活动，1表示跳转到视频，2表示跳转到图文，3表示跳转到小程序，4表示跳转到外链
     *
     * @Column()
     *
     * @var int|null
     */
    private $type;

    /**
     * 跳转到的活动的ID
     *
     * @Column(name="activity_id", prop="activityId")
     *
     * @var int|null
     */
    private $activityId;

    /**
     * 推文ID
     *
     * @Column(name="post_id", prop="postId")
     *
     * @var int|null
     */
    private $postId;

    /**
     * 跳转到的小程序路径
     *
     * @Column(name="mini_program_url", prop="miniProgramUrl")
     *
     * @var string|null
     */
    private $miniProgramUrl;

    /**
     * 跳转到的外链的url
     *
     * @Column(name="outside_url", prop="outsideUrl")
     *
     * @var string|null
     */
    private $outsideUrl;

    /**
     * 发布状态，0表示未发布，1表示已发布
     *
     * @Column()
     *
     * @var int|null
     */
    private $status;

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
     * @param string|null $thumb
     *
     * @return self
     */
    public function setThumb(?string $thumb): self
    {
        $this->thumb = $thumb;

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
     * @param int|null $postId
     *
     * @return self
     */
    public function setPostId(?int $postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * @param string|null $miniProgramUrl
     *
     * @return self
     */
    public function setMiniProgramUrl(?string $miniProgramUrl): self
    {
        $this->miniProgramUrl = $miniProgramUrl;

        return $this;
    }

    /**
     * @param string|null $outsideUrl
     *
     * @return self
     */
    public function setOutsideUrl(?string $outsideUrl): self
    {
        $this->outsideUrl = $outsideUrl;

        return $this;
    }

    /**
     * @param int|null $status
     *
     * @return self
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

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
    public function getThumb(): ?string
    {
        return $this->thumb;
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
    public function getActivityId(): ?int
    {
        return $this->activityId;
    }

    /**
     * @return int|null
     */
    public function getPostId(): ?int
    {
        return $this->postId;
    }

    /**
     * @return string|null
     */
    public function getMiniProgramUrl(): ?string
    {
        return $this->miniProgramUrl;
    }

    /**
     * @return string|null
     */
    public function getOutsideUrl(): ?string
    {
        return $this->outsideUrl;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
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
