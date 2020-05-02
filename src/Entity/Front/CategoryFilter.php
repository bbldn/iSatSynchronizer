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
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
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

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getFilterId(): ?int
    {
        return $this->filterId;
    }

    public function setFilterId(int $filterId): self
    {
        $this->filterId = $filterId;

        return $this;
    }
}
