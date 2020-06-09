<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_discontinued`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductDiscontinuedRepository")
 */
class ProductDiscontinued
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductDiscontinued
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}
