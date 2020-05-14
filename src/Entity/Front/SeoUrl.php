<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_seo_url`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\SeoUrlRepository")
 */
class SeoUrl
{
    /**
     * @var int|null $seoUrlId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`seo_url_id`")
     */
    protected $seoUrlId;

    /**
     * @var int|null $storeId
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string|null $query
     * @ORM\Column(type="string", name="`query`", length=255)
     */
    protected $query;

    /**
     * @var string|null $keyword
     * @ORM\Column(type="string", name="`keyword`", length=255)
     */
    protected $keyword;

    /**
     * @return int|null
     */
    public function getSeoUrlId(): ?int
    {
        return $this->seoUrlId;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     * @return SeoUrl
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

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
     * @return SeoUrl
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return SeoUrl
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     * @return SeoUrl
     */
    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }
}
