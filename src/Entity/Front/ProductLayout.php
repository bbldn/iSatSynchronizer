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
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $storeId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @var int|null $layoutId
     * @ORM\Column(type="integer", name="`layout_id`")
     */
    protected $layoutId;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductLayout
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
     * @return ProductLayout
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLayoutId(): ?int
    {
        return $this->layoutId;
    }

    /**
     * @param int $layoutId
     * @return ProductLayout
     */
    public function setLayoutId(int $layoutId): self
    {
        $this->layoutId = $layoutId;

        return $this;
    }
}
