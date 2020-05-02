<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_seo_url`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\SeoUrlRepository")
 */
class SeoUrl
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`seo_url_id`")
     */
    protected $seoUrlId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @ORM\Column(type="string", name="`query`", length=255)
     */
    protected $query;

    /**
     * @ORM\Column(type="string", name="`keyword`", length=255)
     */
    protected $keyword;

    public function fill(
        int $storeId,
        int $languageId,
        string $query,
        string $keyword
    )
    {
        $this->storeId = $storeId;
        $this->languageId = $languageId;
        $this->query = $query;
        $this->keyword = $keyword;
    }

    public function getSeoUrlId(): ?int
    {
        return $this->seoUrlId;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

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

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }
}
