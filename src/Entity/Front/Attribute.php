<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeRepository")
 */
class Attribute extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`attribute_group_id`")
     */
    private $attributeGroupId;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder;

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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
