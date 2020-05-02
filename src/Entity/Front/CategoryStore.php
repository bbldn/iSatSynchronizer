<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_to_store`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryStoreRepository")
 */
class CategoryStore
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @param int $categoryId
     * @param int $storeId
     */
    public function fill(
        int $categoryId,
        int $storeId
    )
    {
        $this->categoryId = $categoryId;
        $this->storeId = $storeId;
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

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }
}
