<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_category_to_layout")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryLayoutRepository")
 */
class CategoryLayout
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $store_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $layout_id;

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getStoreId(): ?int
    {
        return $this->store_id;
    }

    public function setStoreId(int $store_id): self
    {
        $this->store_id = $store_id;

        return $this;
    }

    public function getLayoutId(): ?int
    {
        return $this->layout_id;
    }

    public function setLayoutId(int $layout_id): self
    {
        $this->layout_id = $layout_id;

        return $this;
    }
}
