<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_option`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderOptionRepository")
 */
class OrderOption extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_option_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="integer", name="`order_product_id`")
     */
    private $orderProductId;

    /**
     * @ORM\Column(type="integer", name="`product_option_id`")
     */
    private $productOptionId;

    /**
     * @ORM\Column(type="integer", name="`product_option_value_id`")
     */
    private $productOptionValueId = 0;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="`value`")
     */
    private $value;

    /**
     * @ORM\Column(type="string", name="`type`", length=32)
     */
    private $type;

    /**
     * @ORM\Column(type="string", name="`sku`")
     */
    private $sku;

    /**
     * @ORM\Column(type="string", name="`model`")
     */
    private $model;

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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
