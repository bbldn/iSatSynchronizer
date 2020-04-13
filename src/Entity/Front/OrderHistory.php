<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_history`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderHistoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderHistory extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_history_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    private $orderStatusId;

    /**
     * @ORM\Column(type="boolean", name="`notify`")
     */
    private $notify = 0;

    /**
     * @ORM\Column(type="string", name="`comment`")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @param int $orderId
     * @param int $orderStatusId
     * @param bool $notify
     * @param string $comment
     */
    public function fill(
        int $orderId,
        int $orderStatusId,
        bool $notify,
        string $comment
    )
    {
        $this->orderId = $orderId;
        $this->orderStatusId = $orderStatusId;
        $this->notify = $notify;
        $this->comment = $comment;
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

    public function getOrderStatusId(): ?int
    {
        return $this->orderStatusId;
    }

    public function setOrderStatusId(int $orderStatusId): self
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    public function setNotify(bool $notify): self
    {
        $this->notify = $notify;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
