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
     * @var int|null $categoryId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @var int|null $storeId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return CategoryStore
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     * @return CategoryStore
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }
}
