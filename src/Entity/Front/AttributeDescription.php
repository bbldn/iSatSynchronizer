<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_attribute_description`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AttributeDescriptionRepository")
 */
class AttributeDescription extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="`name`", length=64)
     */
    private $name;

    public function fill(
        int $attributeId,
        int $languageId,
        string $name
    )
    {
        $this->id = $attributeId;
        $this->languageId = $languageId;
        $this->name = $name;
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
