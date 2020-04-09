<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_related`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRelatedRepository")
 */
class ProductRelated extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="`related_id`")
     */
    private $relatedId;

    /**
     * @param int $productId
     * @param int $relatedId
     */
    public function fill(
        int $productId,
        int $relatedId
    )
    {
        $this->productId = $productId;
        $this->relatedId = $relatedId;
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

    public function getRelatedId(): ?int
    {
        return $this->relatedId;
    }

    public function setRelatedId(int $relatedId): self
    {
        $this->relatedId = $relatedId;

        return $this;
    }
}
