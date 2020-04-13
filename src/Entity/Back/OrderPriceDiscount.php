<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_price_discount`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderPriceDiscountRepository")
 */
class OrderPriceDiscount extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`discount_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="float", name="`price_range`", nullable=true)
     */
    private $priceRange;

    /**
     * @ORM\Column(type="float", name="`percent_discount`", nullable=true)
     */
    private $percentDiscount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPriceRange(): ?float
    {
        return $this->priceRange;
    }

    public function setPriceRange(float $priceRange): self
    {
        $this->priceRange = $priceRange;

        return $this;
    }

    public function getPercentDiscount(): ?float
    {
        return $this->percentDiscount;
    }

    public function setPercentDiscount(?float $percentDiscount): self
    {
        $this->percentDiscount = $percentDiscount;

        return $this;
    }
}
