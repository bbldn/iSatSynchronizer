<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute_group`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeGroupRepository")
 */
class AttributeGroup extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`attribute_group_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder;

    /**
     * @param int $sortOrder
     */
    public function fill(int $sortOrder)
    {
        $this->sortOrder = $sortOrder;
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

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
