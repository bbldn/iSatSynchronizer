<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_to_layout`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryLayoutRepository")
 */
class CategoryLayout
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @ORM\Column(type="integer", name="`layout_id`")
     */
    protected $layoutId;

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
        $this->categoryId = $categoryId;
        $this->storeId = $storeId;
        $this->layoutId = $layoutId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

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
