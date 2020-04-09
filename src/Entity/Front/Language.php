<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_language`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\LanguageRepository")
 */
class Language extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="`name`", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="`code`", length=5)
     */
    private $code;

    /**
     * @ORM\Column(type="string", name="`locale`", length=255)
     */
    private $locale;

    /**
     * @ORM\Column(type="string", name="`image`", length=64)
     */
    private $image;

    /**
     * @ORM\Column(type="string", name="`directory`", length=32)
     */
    private $directory;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder = 0;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    private $status;

    /**
     * Language constructor.
     * @param $name
     * @param $code
     * @param $locale
     * @param $image
     * @param $directory
     * @param $sortOrder
     * @param $status
     */
    public function fill(
        string $name,
        string $code,
        string $locale,
        string $image,
        string $directory,
        int $sortOrder,
        bool $status
    )
    {
        $this->name = $name;
        $this->code = $code;
        $this->locale = $locale;
        $this->image = $image;
        $this->directory = $directory;
        $this->sortOrder = $sortOrder;
        $this->status = $status;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
