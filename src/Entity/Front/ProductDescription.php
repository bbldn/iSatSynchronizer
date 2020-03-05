<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_product_description")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductDescriptionRepository")
 */
class ProductDescription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="product_id")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="language_id")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="name", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="description")
     */
    private $description;

    /**
     * @ORM\Column(type="string", name="tag")
     */
    private $tag;

    /**
     * @ORM\Column(type="string", name="meta_title", length=255)
     */
    private $metaTitle;

    /**
     * @ORM\Column(type="string", name="meta_h1", length=255)
     */
    private $metaH1;

    /**
     * @ORM\Column(type="string", name="meta_description", length=255)
     */
    private $metaDescription;

    /**
     * @ORM\Column(type="string", name="meta_keyword", length=255)
     */
    private $metaKeyword;

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaH1(): ?string
    {
        return $this->metaH1;
    }

    public function setMetaH1(string $metaH1): self
    {
        $this->metaH1 = $metaH1;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaKeyword(): ?string
    {
        return $this->metaKeyword;
    }

    public function setMetaKeyword(string $metaKeyword): self
    {
        $this->metaKeyword = $metaKeyword;

        return $this;
    }
}
