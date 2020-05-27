<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`address`")
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Address
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
     * @var int|null $customerBackId
     * @ORM\Column(type="integer", name="`customer_back_id`")
     */
    protected $customerBackId;

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
     * @return Address
     */
    public function setFrontId(int $frontId): self
    {
        $this->frontId = $frontId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerBackId(): ?int
    {
        return $this->customerBackId;
    }

    /**
     * @param int $customerBackId
     * @return Address
     */
    public function setCustomerBackId(int $customerBackId): self
    {
        $this->customerBackId = $customerBackId;

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
     * @return Address
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
     * @return Address
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
