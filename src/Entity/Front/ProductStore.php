<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_store`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductStoreRepository")
 */
class ProductStore
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId = 0;

    /**
     * @param int $productId
     * @param int $storeId
     */
    public function fill(
        int $productId,
        int $storeId
    )
    {
        $this->productId = $productId;
        $this->storeId = $storeId;
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
}
