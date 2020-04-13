<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_category`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductCategoryRepository")
 */
class ProductCategory extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="product_id")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="category_id")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="boolean", name="main_category")
     */
    private $mainCategory = false;

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
        $this->id = $productId;
        $this->categoryId = $categoryId;
        $this->mainCategory = $mainCategory;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
