<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_language`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\LanguageRepository")
 */
class Language
{
    /**
     * @var int $languageId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string $name
     * @ORM\Column(type="string", name="`name`", length=32)
     */
    protected $name;

    /**
     * @var string $code
     * @ORM\Column(type="string", name="`code`", length=5)
     */
    protected $code;

    /**
     * @var string $locale
     * @ORM\Column(type="string", name="`locale`", length=255)
     */
    protected $locale;

    /**
     * @var string $image
     * @ORM\Column(type="string", name="`image`", length=64)
     */
    protected $image;

    /**
     * @var string $directory
     * @ORM\Column(type="string", name="`directory`", length=32)
     */
    protected $directory;

    /**
     * @var int $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder = 0;

    /**
     * @var bool $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

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

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
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
     * @return Language
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Language
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return Language
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Language
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @return Language
     */
    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return Language
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return Language
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
