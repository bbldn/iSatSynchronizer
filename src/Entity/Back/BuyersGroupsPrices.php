<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups_prices`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsPricesRepository")
 */
class BuyersGroupsPrices
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @var int|null $groupId
     * @ORM\Column(type="integer", name="`group_id`")
     */
    protected $groupId;

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
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return BuyersGroupsPrices
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return BuyersGroupsPrices
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

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
     * @return BuyersGroupsPrices
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
