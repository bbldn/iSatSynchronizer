<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_store`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductStoreRepository")
 */
class ProductStore extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    private $storeId = 0;

    /**
     * @param int $productId
     * @param int $storeId
     */
    public function fill(
        int $productId,
        int $storeId
    )
    {
        $this->id = $productId;
        $this->storeId = $storeId;
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
