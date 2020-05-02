<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute_description`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeDescriptionRepository")
 */
class AttributeDescription
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    protected $attributeId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @ORM\Column(type="string", name="`name`", length=64)
     */
    protected $name;

    public function fill(
        int $attributeId,
        int $languageId,
        string $name
    )
    {
        $this->attributeId = $attributeId;
        $this->languageId = $languageId;
        $this->name = $name;
    }

    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    public function setAttributeId(int $attributeId): self
    {
        $this->attributeId = $attributeId;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
