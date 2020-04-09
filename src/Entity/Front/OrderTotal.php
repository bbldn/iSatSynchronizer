<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_total`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderTotalRepository")
 */
class OrderTotal extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_total_id`")
     */
    private $orderTotalId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", name="`code`", length=32)
     */
    private $code;

    /**
     * @ORM\Column(type="string", name="`title`", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="float", name="`value`")
     */
    private $value = 0.0;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder;

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

    public function getOrderTotalId(): ?int
    {
        return $this->orderTotalId;
    }

    public function setOrderTotalId(int $orderTotalId): self
    {
        $this->orderTotalId = $orderTotalId;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
