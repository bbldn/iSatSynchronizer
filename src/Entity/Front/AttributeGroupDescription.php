<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute_group_description`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeGroupDescriptionRepository")
 */
class AttributeGroupDescription
{
    /**
     * @var int|null $attributeGroupId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`attribute_group_id`")
     */
    protected $attributeGroupId;

    /**
     * @var int|null $languageId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=64)
     */
    protected $name;

    /**
     * @return int|null
     */
    public function getAttributeGroupId(): ?int
    {
        return $this->attributeGroupId;
    }

    /**
     * @param int $attributeGroupId
     * @return AttributeGroupDescription
     */
    public function setAttributeGroupId(int $attributeGroupId): self
    {
        $this->attributeGroupId = $attributeGroupId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     * @return AttributeGroupDescription
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AttributeGroupDescription
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
