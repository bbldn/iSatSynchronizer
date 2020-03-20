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
    private $productId;

    /**
     * @ORM\Column(type="integer", name="category_id")
     */
    private $categoryId;

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
}
