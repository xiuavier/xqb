<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 用户表
 * Class User
 *
 * @since 2.0
 *
 * @Entity(table="user")
 */
class User extends Model
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
     * 用户编号，无序的
     *
     * @Column(name="user_no", prop="userNo")
     *
     * @var int
     */
    private $userNo;

    /**
     * 昵称
     *
     * @Column()
     *
     * @var string|null
     */
    private $nickname;

    /**
     * 头像
     *
     * @Column()
     *
     * @var string|null
     */
    private $avatar;

    /**
     * 性别
     *
     * @Column()
     *
     * @var int|null
     */
    private $gender;

    /**
     * 手机号
     *
     * @Column()
     *
     * @var int|null
     */
    private $mobile;

    /**
     * 微信open_id
     *
     * @Column(name="open_id", prop="openId")
     *
     * @var string|null
     */
    private $openId;

    /**
     * 微信union_id
     *
     * @Column(name="union_id", prop="unionId")
     *
     * @var string|null
     */
    private $unionId;

    /**
     * 角色，0表示普通用户
     *
     * @Column()
     *
     * @var int|null
     */
    private $role;

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
     * @param int $userNo
     *
     * @return self
     */
    public function setUserNo(int $userNo): self
    {
        $this->userNo = $userNo;

        return $this;
    }

    /**
     * @param string|null $nickname
     *
     * @return self
     */
    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @param string|null $avatar
     *
     * @return self
     */
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @param int|null $gender
     *
     * @return self
     */
    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @param int|null $mobile
     *
     * @return self
     */
    public function setMobile(?int $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @param string|null $openId
     *
     * @return self
     */
    public function setOpenId(?string $openId): self
    {
        $this->openId = $openId;

        return $this;
    }

    /**
     * @param string|null $unionId
     *
     * @return self
     */
    public function setUnionId(?string $unionId): self
    {
        $this->unionId = $unionId;

        return $this;
    }

    /**
     * @param int|null $role
     *
     * @return self
     */
    public function setRole(?int $role): self
    {
        $this->role = $role;

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
    public function getUserNo(): ?int
    {
        return $this->userNo;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @return int|null
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * @return int|null
     */
    public function getMobile(): ?int
    {
        return $this->mobile;
    }

    /**
     * @return string|null
     */
    public function getOpenId(): ?string
    {
        return $this->openId;
    }

    /**
     * @return string|null
     */
    public function getUnionId(): ?string
    {
        return $this->unionId;
    }

    /**
     * @return int|null
     */
    public function getRole(): ?int
    {
        return $this->role;
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
