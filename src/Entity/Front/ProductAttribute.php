<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_attribute`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductAttributeRepository")
 */
class ProductAttribute extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    private $attributeId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="`text`")
     */
    private $text;

    /**
     * @param int $productId
     * @param int $attributeId
     * @param int $languageId
     * @param string $text
     */
    public function fill(
        int $productId,
        int $attributeId,
        int $languageId,
        string $text
    )
    {
        $this->id = $productId;
        $this->attributeId = $attributeId;
        $this->languageId = $languageId;
        $this->text = $text;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
