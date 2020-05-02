<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute_group`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeGroupRepository")
 */
class AttributeGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`attribute_group_id`")
     */
    protected $attributeGroupId;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder;

    /**
     * @param int $sortOrder
     */
    public function fill(int $sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    public function getAttributeGroupId(): ?int
    {
        return $this->attributeGroupId;
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
