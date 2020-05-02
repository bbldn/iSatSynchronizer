<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeRepository")
 */
class Attribute
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    protected $attributeId;

    /**
     * @ORM\Column(type="integer", name="`attribute_group_id`")
     */
    protected $attributeGroupId;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder;

    /**
     * @param int $attributeGroupId
     * @param int $sortOrder
     */
    public function fill(
        int $attributeGroupId,
        int $sortOrder
    )
    {
        $this->attributeGroupId = $attributeGroupId;
        $this->sortOrder = $sortOrder;
    }


    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    public function getAttributeGroupId(): ?int
    {
        return $this->attributeGroupId;
    }

    public function setAttributeGroupId(int $attributeGroupId): self
    {
        $this->attributeGroupId = $attributeGroupId;

        return $this;
    }

    public function getSortOrder(): ?string
    {
        return $this->sortOrder;
    }

    public function setSortOrder(string $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
