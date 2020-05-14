<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_total`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderTotalRepository")
 */
class OrderTotal
{
    /**
     * @var int|null $orderTotalId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_total_id`")
     */
    protected $orderTotalId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=32)
     */
    protected $code;

    /**
     * @var string|null $title
     * @ORM\Column(type="string", name="`title`", length=255)
     */
    protected $title;

    /**
     * @var float|null $value
     * @ORM\Column(type="float", name="`value`")
     */
    protected $value = 0.0;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder;

    public function fill(
        int $orderId,
        string $code,
        string $title,
        float $value,
        int $sortOrder
    )
    {
        $this->orderId = $orderId;
        $this->code = $code;
        $this->title = $title;
        $this->value = $value;
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return int|null
     */
    public function getOrderTotalId(): ?int
    {
        return $this->orderTotalId;
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
     * @return OrderTotal
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return OrderTotal
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return OrderTotal
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return OrderTotal
     */
    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return OrderTotal
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
