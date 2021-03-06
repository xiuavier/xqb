<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 资源表
 * Class Resource
 *
 * @since 2.0
 *
 * @Entity(table="resource")
 */
class Resource extends Model
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
     * 资源所属的用户id
     *
     * @Column(name="user_id", prop="userId")
     *
     * @var int
     */
    private $userId;

    /**
     * 所属的推文id
     *
     * @Column(name="post_id", prop="postId")
     *
     * @var int|null
     */
    private $postId;

    /**
     * 资源类型，0表示视频，1表示图片
     *
     * @Column()
     *
     * @var int
     */
    private $type;

    /**
     * 图片或视频资源的阿里云id
     *
     * @Column(name="ali_id", prop="aliId")
     *
     * @var string|null
     */
    private $aliId;

    /**
     * 资源路径
     *
     * @Column()
     *
     * @var string
     */
    private $url;

    /**
     * 视频封面图
     *
     * @Column(name="cover_url", prop="coverUrl")
     *
     * @var string|null
     */
    private $coverUrl;

    /**
     * 创建时间
     *
     * @Column(name="created_at", prop="createdAt")
     *
     * @var int|null
     */
    private $createdAt;

    /**
     * 更新时间
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var int|null
     */
    private $updatedAt;

    /**
     * 删除时间
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
     * @param int $userId
     *
     * @return self
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

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
     * @param int $type
     *
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string|null $aliId
     *
     * @return self
     */
    public function setAliId(?string $aliId): self
    {
        $this->aliId = $aliId;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string|null $coverUrl
     *
     * @return self
     */
    public function setCoverUrl(?string $coverUrl): self
    {
        $this->coverUrl = $coverUrl;

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
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return int|null
     */
    public function getPostId(): ?int
    {
        return $this->postId;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getAliId(): ?string
    {
        return $this->aliId;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getCoverUrl(): ?string
    {
        return $this->coverUrl;
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
