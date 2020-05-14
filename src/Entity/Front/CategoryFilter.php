<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_filter`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryFilterRepository")
 */
class CategoryFilter
{
    /**
     * @var int|null $categoryId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @var int|null $filterId
     * @ORM\Column(type="integer", name="`filter_id`")
     */
    protected $filterId;

    /**
     * @param int $categoryId
     * @param int $filterId
     */
    public function fill(
        int $categoryId,
        int $filterId
    )
    {
        $this->categoryId = $categoryId;
        $this->filterId = $filterId;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return CategoryFilter
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFilterId(): ?int
    {
        return $this->filterId;
    }

    /**
     * @param int $filterId
     * @return CategoryFilter
     */
    public function setFilterId(int $filterId): self
    {
        $this->filterId = $filterId;

        return $this;
    }
}
