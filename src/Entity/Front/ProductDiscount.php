<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_discount`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductDiscountRepository")
 */
class ProductDiscount
{
    /**
     * @var int|null $productDiscountId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_discount_id`")
     */
    protected $productDiscountId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $customerGroupId
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId;

    /**
     * @var int|null $quantity
     * @ORM\Column(type="integer", name="`quantity`")
     */
    protected $quantity = 0;

    /**
     * @var int|null $priority
     * @ORM\Column(type="integer", name="`priority`")
     */
    protected $priority = 1;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price = 0.0;

    /**
     * @var DateTimeInterface|null $dateStart
     * @ORM\Column(type="date", name="`date_start`")
     */
    protected $dateStart;

    /**
     * @var DateTimeInterface|null $dateEnd
     * @ORM\Column(type="date", name="`date_end`")
     */
    protected $dateEnd;

    /**
     * @return int|null
     */
    public function getProductDiscountId(): ?int
    {
        return $this->productDiscountId;
    }

    /**
     * @param int $productDiscountId
     * @return ProductDiscount
     */
    public function setProductDiscountId(int $productDiscountId): self
    {
        $this->productDiscountId = $productDiscountId;

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
     * @param int $productId
     * @return ProductDiscount
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    /**
     * @param int $customerGroupId
     * @return ProductDiscount
     */
    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ProductDiscount
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return ProductDiscount
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

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
     * @param float $price
     * @return ProductDiscount
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateStart(): ?DateTimeInterface
    {
        return $this->dateStart;
    }

    /**
     * @param DateTimeInterface $dateStart
     * @return ProductDiscount
     */
    public function setDateStart(DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateEnd(): ?DateTimeInterface
    {
        return $this->dateEnd;
    }

    /**
     * @param DateTimeInterface $dateEnd
     * @return ProductDiscount
     */
    public function setDateEnd(DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}
