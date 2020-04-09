<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`address`")
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Address extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`front_id`")
     */
    private $frontId;

    /**
     * @ORM\Column(type="integer", name="`order_back_id`")
     */
    private $orderBackId;

    /**
     * @ORM\Column(type="datetime", name="`created_at`", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="`updated_at`", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrontId(): ?int
    {
        return $this->frontId;
    }

    public function setFrontId(int $frontId): self
    {
        $this->frontId = $frontId;

        return $this;
    }

    public function getOrderBackId(): ?int
    {
        return $this->orderBackId;
    }

    public function setOrderBackId(int $orderBackId): self
    {
        $this->orderBackId = $orderBackId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
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
        $this->setUpdatedAt(new \DateTime('now'));

        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
