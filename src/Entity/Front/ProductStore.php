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
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $storeId
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

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductStore
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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
     * @return ProductStore
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }
}
