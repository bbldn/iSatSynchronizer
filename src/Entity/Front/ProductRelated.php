<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_related`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRelatedRepository")
 */
class ProductRelated
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $relatedId
     * @ORM\Column(type="integer", name="`related_id`")
     */
    protected $relatedId;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductRelated
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRelatedId(): ?int
    {
        return $this->relatedId;
    }

    /**
     * @param int $relatedId
     * @return ProductRelated
     */
    public function setRelatedId(int $relatedId): self
    {
        $this->relatedId = $relatedId;

        return $this;
    }
}
