<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_shipment`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderShipmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderShipment extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_shipment_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @ORM\Column(type="string", name="`shipping_courier_id`", length=255)
     */
    private $shippingCourierId;

    /**
     * @ORM\Column(type="string", name="`tracking_number`", length=255)
     */
    private $trackingNumber;

    /**
     * @param int $orderId
     * @param \DateTimeInterface $dateAdded
     * @param int $shippingCourierId
     * @param string $trackingNumber
     */
    public function fill(
        int $orderId,
        \DateTimeInterface $dateAdded,
        int $shippingCourierId,
        string $trackingNumber
    )
    {
        $this->orderId = $orderId;
        $this->dateAdded = $dateAdded;
        $this->shippingCourierId = $shippingCourierId;
        $this->trackingNumber = $trackingNumber;
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

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getShippingCourierId(): ?string
    {
        return $this->shippingCourierId;
    }

    public function setShippingCourierId(string $shippingCourierId): self
    {
        $this->shippingCourierId = $shippingCourierId;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
