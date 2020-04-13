<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_layout`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductLayoutRepository")
 */
class ProductLayout extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    private $storeId;

    /**
     * @ORM\Column(type="integer", name="`layout_id`")
     */
    private $layoutId;

    /**
     * @param int $productId
     * @param int $storeId
     * @param int $layoutId
     */
    public function fill(
        int $productId,
        int $storeId,
        int $layoutId
    )
    {
        $this->id = $productId;
        $this->storeId = $storeId;
        $this->layoutId = $layoutId;
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

    public function getLayoutId(): ?int
    {
        return $this->layoutId;
    }

    public function setLayoutId(int $layoutId): self
    {
        $this->layoutId = $layoutId;

        return $this;
    }
}
