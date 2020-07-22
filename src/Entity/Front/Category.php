<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @var int|null $categoryId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @var string|null $image
     * @ORM\Column(type="string", name="`image`", nullable=true)
     */
    protected $image = null;

    /**
     * @var int|null $parentId
     * @ORM\Column(type="integer", name="`parent_id`")
     */
    protected $parentId = 0;

    /**
     * @var bool|null $top
     * @ORM\Column(type="boolean", name="`top`")
     */
    protected $top;

    /**
     * @var int|null $column
     * @ORM\Column(type="integer", name="`column`")
     */
    protected $column;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="sort_order")
     */
    protected $sortOrder = 0;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @var DateTimeInterface|null $dateModified
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    protected $dateModified;

    /**
     * Category constructor.
     * @param int|null $categoryId
     * @param null|string $image
     * @param int|null $parentId
     * @param bool|null $top
     * @param int|null $column
     * @param int|null $sortOrder
     * @param bool|null $status
     * @param DateTimeInterface|null $dateAdded
     * @param DateTimeInterface|null $dateModified
     */
    public function __construct(
        ?int $categoryId = null,
        ?string $image = null,
        ?int $parentId = null,
        ?bool $top = null,
        ?int $column = null,
        ?int $sortOrder = null,
        ?bool $status = null,
        ?DateTimeInterface $dateAdded = null,
        ?DateTimeInterface $dateModified = null
    )
    {
        $this->categoryId = $categoryId;
        $this->image = $image;
        $this->parentId = $parentId;
        $this->top = $top;
        $this->column = $column;
        $this->sortOrder = $sortOrder;
        $this->status = $status;
        $this->dateAdded = $dateAdded;
        $this->dateModified = $dateModified;
    }


    /**
     * @param int|null $categoryId
     * @return Category
     */
    public function setCategoryId(?int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Category
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     * @return Category
     */
    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTop(): ?bool
    {
        return $this->top;
    }

    /**
     * @param bool $top
     * @return Category
     */
    public function setTop(bool $top): self
    {
        $this->top = $top;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getColumn(): ?int
    {
        return $this->column;
    }

    /**
     * @param int $column
     * @return Category
     */
    public function setColumn(int $column): self
    {
        $this->column = $column;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return Category
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return Category
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateModified(): ?DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param DateTimeInterface $dateModified
     * @return Category
     */
    public function setDateModified(DateTimeInterface $dateModified): self
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
        $this->setDateModified(new DateTime('now'));

        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new DateTime('now'));
        }
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTimeInterface $dateAdded
     * @return Category
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
