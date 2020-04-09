<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_image`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductImageRepository")
 */
class ProductImage extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_image_id`")
     */
    private $productImageId;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`image`", nullable=true, length=255)
     */
    private $image = null;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder = 0;

    /**
     * @param int $productId
     * @param string $image
     * @param int $sortOrder
     */
    public function fill(
        int $productId,
        string $image,
        int $sortOrder
    )
    {
        $this->productId = $productId;
        $this->image = $image;
        $this->sortOrder = $sortOrder;
    }


    public function getProductImageId(): ?int
    {
        return $this->productImageId;
    }

    public function setProductImageId(int $productImageId): self
    {
        $this->productImageId = $productImageId;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
