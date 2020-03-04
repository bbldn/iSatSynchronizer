<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_category_description")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryDescriptionRepository")
 */
class CategoryDescription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $category_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $language_id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     */
    private $description;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_title;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_h1;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_description;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_keyword;

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id): self
    {
        $this->language_id = $language_id;

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
        return $this->meta_title;
    }

    public function setMetaTitle(string $meta_title): self
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaH1(): ?string
    {
        return $this->meta_h1;
    }

    public function setMetaH1(string $meta_h1): self
    {
        $this->meta_h1 = $meta_h1;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): self
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getMetaKeyword(): ?string
    {
        return $this->meta_keyword;
    }

    public function setMetaKeyword(string $meta_keyword): self
    {
        $this->meta_keyword = $meta_keyword;

        return $this;
    }

}
