<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_related`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRelatedRepository")
 */
class ProductRelated extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $id;

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
        $this->id = $productId;
        $this->relatedId = $relatedId;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
