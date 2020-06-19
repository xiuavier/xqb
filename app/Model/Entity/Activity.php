<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 活动表
 * Class Activity
 *
 * @since 2.0
 *
 * @Entity(table="activity")
 */
class Activity extends Model
{
    /**
     * 活动背景图片url
     *
     * @Column(name="bg_url", prop="bgUrl")
     *
     * @var string|null
     */
    private $bgUrl;

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
     * @Column(name="deleted_at", prop="deletedAt")
     *
     * @var int|null
     */
    private $deletedAt;

    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 活动规则图片url
     *
     * @Column(name="rule_url", prop="ruleUrl")
     *
     * @var string|null
     */
    private $ruleUrl;

    /**
     * 分享标语
     *
     * @Column()
     *
     * @var string|null
     */
    private $slogan;

    /**
     * 发布状态，0表示未发布，1表示发布，2表示撤销发布
     *
     * @Column()
     *
     * @var int|null
     */
    private $status;

    /**
     * 活动标签
     *
     * @Column()
     *
     * @var string|null
     */
    private $tag;

    /**
     * 活动封面图片url
     *
     * @Column(name="thumb_url", prop="thumbUrl")
     *
     * @var string|null
     */
    private $thumbUrl;

    /**
     * 活动标题
     *
     * @Column()
     *
     * @var string|null
     */
    private $title;

    /**
     * 活动类型，0快乐成长，1安全成长
     *
     * @Column()
     *
     * @var int|null
     */
    private $type;

    /**
     * 
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var int|null
     */
    private $updatedAt;


    /**
     * @param string|null $bgUrl
     *
     * @return self
     */
    public function setBgUrl(?string $bgUrl): self
    {
        $this->bgUrl = $bgUrl;

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
     * @param string|null $ruleUrl
     *
     * @return self
     */
    public function setRuleUrl(?string $ruleUrl): self
    {
        $this->ruleUrl = $ruleUrl;

        return $this;
    }

    /**
     * @param string|null $slogan
     *
     * @return self
     */
    public function setSlogan(?string $slogan): self
    {
        $this->slogan = $slogan;

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
     * @param string|null $thumbUrl
     *
     * @return self
     */
    public function setThumbUrl(?string $thumbUrl): self
    {
        $this->thumbUrl = $thumbUrl;

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
     * @return string|null
     */
    public function getBgUrl(): ?string
    {
        return $this->bgUrl;
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
    public function getDeletedAt(): ?int
    {
        return $this->deletedAt;
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
    public function getRuleUrl(): ?string
    {
        return $this->ruleUrl;
    }

    /**
     * @return string|null
     */
    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return string|null
     */
    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
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
    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

}
