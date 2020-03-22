<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_special`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductSpecialRepository")
 */
class ProductSpecial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_special_id`")
     */
    private $productSpecialId;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    private $customerGroupId;

    /**
     * @ORM\Column(type="integer", name="`priority`")
     */
    private $priority;

    /**
     * @ORM\Column(type="float", name="`price`")
     */
    private $price;

    /**
     * @ORM\Column(type="date", name="`date_start`")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date", name="`date_end`")
     */
    private $dateEnd;

    public function getProductSpecialId(): ?int
    {
        return $this->productSpecialId;
    }

    public function setProductSpecialId(int $productSpecialId): self
    {
        $this->productSpecialId = $productSpecialId;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}