<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_price_discount`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderPriceDiscountRepository")
 */
class OrderPriceDiscount
{
    /**
     * @var int|null $discountId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`discount_id`")
     */
    protected $discountId;

    /**
     * @var float|null $priceRange
     * @ORM\Column(type="float", name="`price_range`", nullable=true)
     */
    protected $priceRange;

    /**
     * @var float|null $percentDiscount
     * @ORM\Column(type="float", name="`percent_discount`", nullable=true)
     */
    protected $percentDiscount;

    /**
     * @return int|null
     */
    public function getDiscountId(): ?int
    {
        return $this->discountId;
    }

    /**
     * @return float|null
     */
    public function getPriceRange(): ?float
    {
        return $this->priceRange;
    }

    /**
     * @param float $priceRange
     * @return OrderPriceDiscount
     */
    public function setPriceRange(float $priceRange): self
    {
        $this->priceRange = $priceRange;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPercentDiscount(): ?float
    {
        return $this->percentDiscount;
    }

    /**
     * @param float|null $percentDiscount
     * @return OrderPriceDiscount
     */
    public function setPercentDiscount(?float $percentDiscount): self
    {
        $this->percentDiscount = $percentDiscount;

        return $this;
    }
}
