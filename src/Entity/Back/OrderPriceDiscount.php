<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_price_discount`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderPriceDiscountRepository")
 */
class OrderPriceDiscount
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`discount_id`")
     */
    protected $discountId;

    /**
     * @ORM\Column(type="float", name="`price_range`", nullable=true)
     */
    protected $priceRange;

    /**
     * @ORM\Column(type="float", name="`percent_discount`", nullable=true)
     */
    protected $percentDiscount;

    public function getDiscountId(): ?int
    {
        return $this->discountId;
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
