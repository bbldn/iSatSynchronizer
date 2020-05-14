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
     * @var int|null $attributeId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    protected $attributeId;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string|null $name
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

    /**
     * @return int|null
     */
    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    /**
     * @param int $attributeId
     * @return AttributeDescription
     */
    public function setAttributeId(int $attributeId): self
    {
        $this->attributeId = $attributeId;

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
     * @return AttributeDescription
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
     * @return AttributeDescription
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
