<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_description`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryDescriptionRepository")
 */
class CategoryDescription
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="`description`")
     */
    protected $description;

    /**
     * @ORM\Column(type="string", name="`meta_title`", length=255)
     */
    protected $metaTitle;

    /**
     * @ORM\Column(type="string", name="`meta_description`", length=255)
     */
    protected $metaDescription;

    /**
     * @ORM\Column(type="string", name="`meta_keyword`", length=255)
     */
    protected $metaKeyword;

    /**
     * @param int $categoryId
     * @param int $languageId
     * @param string $name
     * @param string $description
     * @param string $metaTitle
     * @param string $metaDescription
     * @param string $metaKeyword
     */
    public function fill(
        int $categoryId,
        int $languageId,
        string $name,
        string $description,
        string $metaTitle,
        string $metaDescription,
        string $metaKeyword
    )
    {
        $this->categoryId = $categoryId;
        $this->languageId = $languageId;
        $this->name = $name;
        $this->description = $description;
        $this->metaTitle = $metaTitle;
        $this->metaDescription = $metaDescription;
        $this->metaKeyword = $metaKeyword;
    }


    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;

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

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

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
