<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @ORM\Column(type="string", name="`image`", nullable=true)
     */
    protected $image = null;

    /**
     * @ORM\Column(type="integer", name="`parent_id`")
     */
    protected $parentId = 0;

    /**
     * @ORM\Column(type="boolean", name="`top`")
     */
    protected $top;

    /**
     * @ORM\Column(type="integer", name="`column`")
     */
    protected $column;

    /**
     * @ORM\Column(type="integer", name="sort_order")
     */
    protected $sortOrder = 0;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    protected $dateModified;

    /**
     * @param string $image
     * @param int $parentId
     * @param bool $top
     * @param int $column
     * @param int $sortOrder
     * @param bool $status
     */
    public function fill(
        string $image,
        int $parentId,
        bool $top,
        int $column,
        int $sortOrder,
        bool $status
    )
    {
        $this->image = $image;
        $this->parentId = $parentId;
        $this->top = $top;
        $this->column = $column;
        $this->sortOrder = $sortOrder;
        $this->status = $status;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
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
        return $this->parentId;
    }

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;

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
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

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

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateModified(new \DateTime('now'));

        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
