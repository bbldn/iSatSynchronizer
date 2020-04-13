<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_filter`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductFilterRepository")
 */
class ProductFilter extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $id;

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
        $this->id = $productId;
        $this->filterId = $filterId;
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
