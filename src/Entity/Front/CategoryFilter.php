<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_filter`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryFilterRepository")
 */
class CategoryFilter extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`filter_id`")
     */
    private $filterId;

    /**
     * @param int $categoryId
     * @param int $filterId
     */
    public function fill(
        int $categoryId,
        int $filterId
    )
    {
        $this->id = $categoryId;
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
