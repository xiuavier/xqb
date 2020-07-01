<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 后台管理员表
 * Class Admin
 *
 * @since 2.0
 *
 * @Entity(table="admin")
 */
class Admin extends Model
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
     * 账号
     *
     * @Column()
     *
     * @var string
     */
    private $account;

    /**
     *
     *
     * @Column()
     *
     * @var string
     */
    private $password;

    /**
     * 角色，0表示超级管理员
     *
     * @Column()
     *
     * @var int|null
     */
    private $role;

    /**
     * 账号状态，0表示正常
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
     * @param string $account
     *
     * @return self
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

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
     * @return string
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
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
