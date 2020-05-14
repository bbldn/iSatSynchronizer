<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_shipment`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderShipmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderShipment
{
    /**
     * @var int|null $orderShipmentId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_shipment_id`")
     */
    protected $orderShipmentId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @var string|null $shippingCourierId
     * @ORM\Column(type="string", name="`shipping_courier_id`", length=255)
     */
    protected $shippingCourierId;

    /**
     * @var string|null $trackingNumber
     * @ORM\Column(type="string", name="`tracking_number`", length=255)
     */
    protected $trackingNumber;

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


    /**
     * @return int|null
     */
    public function getOrderShipmentId(): ?int
    {
        return $this->orderShipmentId;
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
     * @return OrderShipment
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCourierId(): ?string
    {
        return $this->shippingCourierId;
    }

    /**
     * @param string $shippingCourierId
     * @return OrderShipment
     */
    public function setShippingCourierId(string $shippingCourierId): self
    {
        $this->shippingCourierId = $shippingCourierId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return OrderShipment
     */
    public function setTrackingNumber(string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTimeInterface $dateAdded
     * @return OrderShipment
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new DateTime('now'));
        }
    }
}
