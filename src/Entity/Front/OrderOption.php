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
     * @var int|null $orderOptionId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_option_id`")
     */
    protected $orderOptionId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var int|null $orderProductId
     * @ORM\Column(type="integer", name="`order_product_id`")
     */
    protected $orderProductId;

    /**
     * @var int|null $productOptionId
     * @ORM\Column(type="integer", name="`product_option_id`")
     */
    protected $productOptionId;

    /**
     * @var int|null $productOptionValueId
     * @ORM\Column(type="integer", name="`product_option_value_id`")
     */
    protected $productOptionValueId = 0;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @var string|null $value
     * @ORM\Column(type="string", name="`value`")
     */
    protected $value;

    /**
     * @var string|null $type
     * @ORM\Column(type="string", name="`type`", length=32)
     */
    protected $type;

    /**
     * @var string|null $sku
     * @ORM\Column(type="string", name="`sku`")
     */
    protected $sku;

    /**
     * @var string|null $model
     * @ORM\Column(type="string", name="`model`")
     */
    protected $model;

    /**
     * @return int|null
     */
    public function getOrderOptionId(): ?int
    {
        return $this->orderOptionId;
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
     * @return OrderOption
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderProductId(): ?int
    {
        return $this->orderProductId;
    }

    /**
     * @param int $orderProductId
     * @return OrderOption
     */
    public function setOrderProductId(int $orderProductId): self
    {
        $this->orderProductId = $orderProductId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductOptionId(): ?int
    {
        return $this->productOptionId;
    }

    /**
     * @param int $productOptionId
     * @return OrderOption
     */
    public function setProductOptionId(int $productOptionId): self
    {
        $this->productOptionId = $productOptionId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductOptionValueId(): ?int
    {
        return $this->productOptionValueId;
    }

    /**
     * @param int $productOptionValueId
     * @return OrderOption
     */
    public function setProductOptionValueId(int $productOptionValueId): self
    {
        $this->productOptionValueId = $productOptionValueId;

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
     * @return OrderOption
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return OrderOption
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return OrderOption
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return OrderOption
     */
    public function setSku(string $sku): self
    {
        $this->sku = $sku;

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
     * @return OrderOption
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }
}
