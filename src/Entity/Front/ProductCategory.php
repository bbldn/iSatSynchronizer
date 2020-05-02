<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_category`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductCategoryRepository")
 */
class ProductCategory
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="product_id")
     */
    protected $productId;

    /**
     * @ORM\Column(type="integer", name="category_id")
     */
    protected $categoryId;

    /**
     * @ORM\Column(type="boolean", name="main_category")
     */
    protected $mainCategory = false;

    /**
     * ProductCategory constructor.
     * @param $productId
     * @param $categoryId
     * @param bool $mainCategory
     */
    public function fill(
        int $productId,
        int $categoryId,
        bool $mainCategory
    )
    {
        $this->productId = $productId;
        $this->categoryId = $categoryId;
        $this->mainCategory = $mainCategory;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
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

    public function getMainCategory(): ?bool
    {
        return $this->mainCategory;
    }

    public function setMainCategory(bool $mainCategory): self
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }
}
