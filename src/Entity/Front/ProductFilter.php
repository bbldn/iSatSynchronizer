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
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="`filter_id`")
     */
    private $filterId;

    /**
     * @param int $productId
     * @param int $filterId
     */
    public function fill(
        int $productId,
        int $filterId
    )
    {
        $this->productId = $productId;
        $this->filterId = $filterId;
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

    public function getFilterId(): ?int
    {
        return $this->filterId;
    }

    public function setFilterId(int $filterId): self
    {
        $this->filterId = $filterId;

        return $this;
    }
}
