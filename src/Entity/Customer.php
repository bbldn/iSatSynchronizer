<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`customers`")
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Customer
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int|null $frontId
     * @ORM\Column(type="integer", name="`front_id`")
     */
    protected $frontId;


    /**
     * @var bool|null $isOrder
     * @ORM\Column(type="boolean", name="`is_order`")
     */
    protected $isOrder = false;

    /**
     * @var int|null $backId
     * @ORM\Column(type="integer", name="`back_id`")
     */
    protected $backId;

    /**
     * @var DateTimeInterface|null $createdAt
     * @ORM\Column(type="datetime", name="`created_at`", nullable=true)
     */
    protected $createdAt;

    /**
     * @var DateTimeInterface|null $updatedAt
     * @ORM\Column(type="datetime", name="`updated_at`", nullable=true)
     */
    protected $updatedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getFrontId(): ?int
    {
        return $this->frontId;
    }

    /**
     * @param int $frontId
     * @return Customer
     */
    public function setFrontId(int $frontId): self
    {
        $this->frontId = $frontId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBackId(): ?int
    {
        return $this->backId;
    }

    /**
     * @param int $backId
     * @return Customer
     */
    public function setBackId(int $backId): self
    {
        $this->backId = $backId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsOrder(): ?bool
    {
        return $this->isOrder;
    }

    /**
     * @param bool|null $isOrder
     * @return Customer
     */
    public function setIsOrder(?bool $isOrder): self
    {
        $this->isOrder = $isOrder;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     * @return Customer
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return Customer
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new DateTime('now'));

        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt(new DateTime('now'));
        }
    }
}
