<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_filter`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductFilterRepository")
 */
class ProductFilter
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`filter_id`")
     */
    protected $filterId;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductFilter
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFilterId(): ?int
    {
        return $this->filterId;
    }

    /**
     * @param int $filterId
     * @return ProductFilter
     */
    public function setFilterId(int $filterId): self
    {
        $this->filterId = $filterId;

        return $this;
    }
}
