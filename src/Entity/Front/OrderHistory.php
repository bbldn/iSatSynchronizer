<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_history`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderHistoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderHistory
{
    /**
     * @var int|null $orderHistoryId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_history_id`")
     */
    protected $orderHistoryId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var int|null $orderStatusId
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    protected $orderStatusId;

    /**
     * @var bool|null $notify
     * @ORM\Column(type="boolean", name="`notify`")
     */
    protected $notify = 0;

    /**
     * @var string|null $comment
     * @ORM\Column(type="string", name="`comment`")
     */
    protected $comment;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @return int|null
     */
    public function getOrderHistoryId(): ?int
    {
        return $this->orderHistoryId;
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
     * @return OrderHistory
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderStatusId(): ?int
    {
        return $this->orderStatusId;
    }

    /**
     * @param int $orderStatusId
     * @return OrderHistory
     */
    public function setOrderStatusId(int $orderStatusId): self
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    /**
     * @param bool $notify
     * @return OrderHistory
     */
    public function setNotify(bool $notify): self
    {
        $this->notify = $notify;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return OrderHistory
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new DateTime('now'));
        }
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
     * @return OrderHistory
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
