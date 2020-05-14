<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_special`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductSpecialRepository")
 */
class ProductSpecial
{
    /**
     * @var int|null $productSpecialId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_special_id`")
     */
    protected $productSpecialId;

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
     * @param int $productId
     * @param int $customerGroupId
     * @param int $priority
     * @param float $price
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     */
    public function fill(
        int $productId,
        int $customerGroupId,
        int $priority,
        float $price,
        \DateTimeInterface $dateStart,
        \DateTimeInterface $dateEnd
    )
    {
        $this->productId = $productId;
        $this->customerGroupId = $customerGroupId;
        $this->priority = $priority;
        $this->price = $price;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return int|null
     */
    public function getProductSpecialId(): ?int
    {
        return $this->productSpecialId;
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
     * @return ProductSpecial
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
     * @return ProductSpecial
     */
    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

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
     * @return ProductSpecial
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
     * @return ProductSpecial
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
     * @return ProductSpecial
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
     * @return ProductSpecial
     */
    public function setDateEnd(DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}
