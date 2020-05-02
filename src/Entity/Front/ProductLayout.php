<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_layout`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductLayoutRepository")
 */
class ProductLayout
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @ORM\Column(type="integer", name="`layout_id`")
     */
    protected $layoutId;

    /**
     * @param int $productId
     * @param int $storeId
     * @param int $layoutId
     */
    public function fill(
        int $productId,
        int $storeId,
        int $layoutId
    )
    {
        $this->productId = $productId;
        $this->storeId = $storeId;
        $this->layoutId = $layoutId;
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

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    public function getLayoutId(): ?int
    {
        return $this->layoutId;
    }

    public function setLayoutId(int $layoutId): self
    {
        $this->layoutId = $layoutId;

        return $this;
    }
}
