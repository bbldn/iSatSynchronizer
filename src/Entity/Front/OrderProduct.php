<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_product`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderProductRepository")
 */
class OrderProduct
{
    /**
     * @var int|null $orderProductId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_product_id`")
     */
    protected $orderProductId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @var string|null $model
     * @ORM\Column(type="string", name="`model`", length=64)
     */
    protected $model;

    /**
     * @var int|null $quantity
     * @ORM\Column(type="integer", name="`quantity`")
     */
    protected $quantity;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price = 0.0;

    /**
     * @var float|null $total
     * @ORM\Column(type="float", name="`total`")
     */
    protected $total = 0.0;

    /**
     * @var float|null $tax
     * @ORM\Column(type="float", name="`tax`")
     */
    protected $tax = 0.0;

    /**
     * @var int|null $reward
     * @ORM\Column(type="integer", name="`reward`")
     */
    protected $reward;

    /**
     * @return int|null
     */
    public function getOrderProductId(): ?int
    {
        return $this->orderProductId;
    }

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return OrderProduct
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

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
     * @return OrderProduct
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return OrderProduct
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return OrderProduct
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

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
     * @return OrderProduct
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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
     * @return OrderProduct
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float $total
     * @return OrderProduct
     */
    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTax(): ?float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     * @return OrderProduct
     */
    public function setTax(float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReward(): ?int
    {
        return $this->reward;
    }

    /**
     * @param int $reward
     * @return OrderProduct
     */
    public function setReward(int $reward): self
    {
        $this->reward = $reward;

        return $this;
    }
}
