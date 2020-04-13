<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_to_layout`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryLayoutRepository")
 */
class CategoryLayout extends Entity
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
     * @ORM\Column(type="integer", name="`layout_id`")
     */
    private $layoutId;

    /**
     * @param int $categoryId
     * @param int $storeId
     * @param int $layoutId
     */
    public function fill(
        int $categoryId,
        int $storeId,
        int $layoutId
    )
    {
        $this->id = $categoryId;
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
