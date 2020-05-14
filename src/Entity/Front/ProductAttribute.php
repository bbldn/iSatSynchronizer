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
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $attributeId
     * @ORM\Column(type="integer", name="`attribute_id`")
     */
    protected $attributeId;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string|null $text
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

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     * @return ProductAttribute
     */
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

        return $this;
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
     * @return ProductAttribute
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
     * @return ProductAttribute
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return ProductAttribute
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
