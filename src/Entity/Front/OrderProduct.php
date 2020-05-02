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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_product_id`")
     */
    protected $orderProductId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="`model`", length=64)
     */
    protected $model;

    /**
     * @ORM\Column(type="integer", name="`quantity`")
     */
    protected $quantity;

    /**
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price = 0.0;

    /**
     * @ORM\Column(type="float", name="`total`")
     */
    protected $total = 0.0;

    /**
     * @ORM\Column(type="float", name="`tax`")
     */
    protected $tax = 0.0;

    /**
     * @ORM\Column(type="integer", name="`reward`")
     */
    protected $reward;

    public function fill(
        int $orderId,
        int $productId,
        string $name,
        string $model,
        int $quantity,
        float $price,
        float $total,
        float $tax,
        int $reward
    )
    {
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->name = $name;
        $this->model = $model;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $total;
        $this->tax = $tax;
        $this->reward = $reward;
    }


    public function getOrderProductId(): ?int
    {
        return $this->orderProductId;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getReward(): ?int
    {
        return $this->reward;
    }

    public function setReward(int $reward): self
    {
        $this->reward = $reward;

        return $this;
    }
}
