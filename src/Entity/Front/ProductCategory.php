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
     * @ORM\Id()
     * @ORM\Column(type="integer", name="category_id")
     */
    protected $categoryId;

    /**
     * ProductCategory constructor.
     * @param int|null $productId
     * @param int|null $categoryId
     */
    public function __construct(
        ?int $productId = null,
        ?int $categoryId = null
    )
    {
        $this->productId = $productId;
        $this->categoryId = $categoryId;
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
}
