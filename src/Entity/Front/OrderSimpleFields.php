<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_simple_fields`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderSimpleFieldsRepository")
 */
class OrderSimpleFields
{
    /**
     * @var int|null $orderId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var string|null $metadata
     * @ORM\Column(type="string", name="`metadata`", length=255)
     */
    protected $metadata;

    /**
     * @param int $orderId
     * @param string $metadata
     */
    public function fill(
        int $orderId,
        string $metadata
    )
    {
        $this->orderId = $orderId;
        $this->metadata = $metadata;
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
     * @return OrderSimpleFields
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    /**
     * @param string $metadata
     * @return OrderSimpleFields
     */
    public function setMetadata(string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }
}
