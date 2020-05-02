<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`categories`")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="`front_id`")
     */
    protected $frontId;

    /**
     * @ORM\Column(type="integer", name="`back_id`")
     */
    protected $backId;

    /**
     * @ORM\Column(type="datetime", name="`created_at`", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="`updated_at`", nullable=true)
     */
    protected $updatedAt;

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

    public function getBackId(): ?int
    {
        return $this->backId;
    }

    public function setBackId(int $backId): self
    {
        $this->backId = $backId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
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
