<?php

namespace App\Entity\Back;

/**
 * @ORM\Table(name="`SS_competitors_products`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\CompetitorsProductsRepository")
 */
class CompetitorsProducts
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var int|null $competitorId
     * @ORM\Column(type="integer", name="`competitorID`")
     */
    protected $competitorId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @var string|null $url
     * @ORM\Column(type="string", name="`url`")
     */
    protected $url;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return CompetitorsProducts
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCompetitorId(): ?int
    {
        return $this->competitorId;
    }

    /**
     * @param int|null $competitorId
     * @return CompetitorsProducts
     */
    public function setCompetitorId(?int $competitorId): self
    {
        $this->competitorId = $competitorId;

        return $this;
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
     * @return CompetitorsProducts
     */
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     * @return CompetitorsProducts
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return CompetitorsProducts
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }
}