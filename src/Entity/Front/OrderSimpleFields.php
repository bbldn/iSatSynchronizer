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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", name="`metadata`", length=255)
     */
    private $metadata;

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }
}
