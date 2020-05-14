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
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="product_id")
     */
    protected $productId;

    /**
     * @var int|null $categoryId
     * @ORM\Column(type="integer", name="category_id")
     */
    protected $categoryId;

    /**
     * @var bool|null $mainCategory
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

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductCategory
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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
     * @param int $categoryId
     * @return ProductCategory
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMainCategory(): ?bool
    {
        return $this->mainCategory;
    }

    /**
     * @param bool $mainCategory
     * @return ProductCategory
     */
    public function setMainCategory(bool $mainCategory): self
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }
}
