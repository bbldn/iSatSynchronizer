<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_option`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderOptionRepository")
 */
class OrderOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_option_id`")
     */
    protected $orderOptionId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @ORM\Column(type="integer", name="`order_product_id`")
     */
    protected $orderProductId;

    /**
     * @ORM\Column(type="integer", name="`product_option_id`")
     */
    protected $productOptionId;

    /**
     * @ORM\Column(type="integer", name="`product_option_value_id`")
     */
    protected $productOptionValueId = 0;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="`value`")
     */
    protected $value;

    /**
     * @ORM\Column(type="string", name="`type`", length=32)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", name="`sku`")
     */
    protected $sku;

    /**
     * @ORM\Column(type="string", name="`model`")
     */
    protected $model;

    public function fill(
        int $orderId,
        int $orderProductId,
        int $productOptionId,
        int $productOptionValueId,
        string $name,
        string $value,
        string $type,
        string $sku,
        string $model)
    {
        $this->orderId = $orderId;
        $this->orderProductId = $orderProductId;
        $this->productOptionId = $productOptionId;
        $this->productOptionValueId = $productOptionValueId;
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->sku = $sku;
        $this->model = $model;
    }

    public function getOrderOptionId(): ?int
    {
        return $this->orderOptionId;
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

    public function getOrderProductId(): ?int
    {
        return $this->orderProductId;
    }

    public function setOrderProductId(int $orderProductId): self
    {
        $this->orderProductId = $orderProductId;

        return $this;
    }

    public function getProductOptionId(): ?int
    {
        return $this->productOptionId;
    }

    public function setProductOptionId(int $productOptionId): self
    {
        $this->productOptionId = $productOptionId;

        return $this;
    }

    public function getProductOptionValueId(): ?int
    {
        return $this->productOptionValueId;
    }

    public function setProductOptionValueId(int $productOptionValueId): self
    {
        $this->productOptionValueId = $productOptionValueId;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

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
}
