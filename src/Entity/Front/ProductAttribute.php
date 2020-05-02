<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_attribute`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductAttributeRepository")
 */
class ProductAttribute
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    protected $attributeId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @ORM\Column(type="string", name="`text`")
     */
    protected $text;

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
        $this->productId = $productId;
        $this->attributeId = $attributeId;
        $this->languageId = $languageId;
        $this->text = $text;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
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
