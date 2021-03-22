<?php
/**
 * Created by Samir_H
 */

namespace EasyOauth\src\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Token
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientId;

    /**
     * You can manage your user Here
     *
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $limit_due;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    public function __construct(string $clientId)
    {
        $this->createdAt = new \DateTime('now');
        $this->userId = 1;
        $this->clientId = $clientId;
        $this->isActive = true;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setTokenId(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return integer
     */
    public function getLimitDue()
    {
        return $this->limit_due;
    }

    /**
     * @param integer $limitDue
     */
    public function setLimitDue($limitDue): void
    {
        $this->limit_due = $limitDue;
    }

}
