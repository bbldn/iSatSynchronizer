<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_category")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $category_id;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;
    /**
     * @ORM\Column(type="integer")
     */
    private $parent_id = 0;
    /**
     * @ORM\Column(type="boolean")
     */
    private $top;
    /**
     * @ORM\Column(type="integer")
     */
    private $column;
    /**
     * @ORM\Column(type="integer")
     */
    private $sort_order = 0;
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_added;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modified;

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->top;
    }

    public function setTop(bool $top): self
    {
        $this->top = $top;

        return $this;
    }

    public function getColumn(): ?int
    {
        return $this->column;
    }

    public function setColumn(int $column): self
    {
        $this->column = $column;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sort_order;
    }

    public function setSortOrder(int $sort_order): self
    {
        $this->sort_order = $sort_order;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->date_added;
    }

    public function setDateAdded(\DateTimeInterface $date_added): self
    {
        $this->date_added = $date_added;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->date_modified;
    }

    public function setDateModified(\DateTimeInterface $date_modified): self
    {
        $this->date_modified = $date_modified;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateModified(new \DateTime('now'));

        if ($this->getDateAdded() == null) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
