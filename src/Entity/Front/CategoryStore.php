<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_to_store`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryStoreRepository")
 */
class CategoryStore extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    private $storeId;

    /**
     * @param int $categoryId
     * @param int $storeId
     */
    public function fill(
        int $categoryId,
        int $storeId
    )
    {
        $this->id = $categoryId;
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
