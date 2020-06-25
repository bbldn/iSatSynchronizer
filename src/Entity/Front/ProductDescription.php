<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_description`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductDescriptionRepository")
 */
class ProductDescription
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $languageId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`")
     */
    protected $description;

    /**
     * @var string|null $tag
     * @ORM\Column(type="string", name="`tag`")
     */
    protected $tag;

    /**
     * @var string|null $metaTitle
     * @ORM\Column(type="string", name="`meta_title`", length=255)
     */
    protected $metaTitle;

    /**
     * @var string|null $metaDescription
     * @ORM\Column(type="string", name="`meta_description`", length=255)
     */
    protected $metaDescription;

    /**
     * @var string|null $metaKeyword
     * @ORM\Column(type="string", name="`meta_keyword`", length=255)
     */
    protected $metaKeyword;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     * @return ProductDescription
     */
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

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
     * @return ProductDescription
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
     * @return ProductDescription
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ProductDescription
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return ProductDescription
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     * @return ProductDescription
     */
    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     * @return ProductDescription
     */
    public function setMetaDescription(string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaKeyword(): ?string
    {
        return $this->metaKeyword;
    }

    /**
     * @param string $metaKeyword
     * @return ProductDescription
     */
    public function setMetaKeyword(string $metaKeyword): self
    {
        $this->metaKeyword = $metaKeyword;

        return $this;
    }
}
