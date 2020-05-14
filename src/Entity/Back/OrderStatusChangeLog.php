<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_status_changelog`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderStatusChangeLogRepository")
 */
class OrderStatusChangeLog
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`orderID`", nullable=true)
     */
    protected $orderId;

    /**
     * @var string|null $statusName
     * @ORM\Column(type="string", name="`status_name`", length=255, nullable=true)
     */
    protected $statusName;

    /**
     * @var DateTimeInterface|null $statusChangeTime
     * @ORM\Column(type="datetime", name="`status_change_time`", nullable=true)
     */
    protected $statusChangeTime;

    /**
     * @var string|null $statusComment
     * @ORM\Column(type="string", name="`status_comment`", length=255, nullable=true)
     */
    protected $statusComment;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return OrderStatusChangeLog
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    /**
     * @param string|null $statusName
     * @return OrderStatusChangeLog
     */
    public function setStatusName(?string $statusName): self
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStatusChangeTime(): ?DateTimeInterface
    {
        return $this->statusChangeTime;
    }

    /**
     * @param DateTimeInterface|null $statusChangeTime
     * @return OrderStatusChangeLog
     */
    public function setStatusChangeTime(?DateTimeInterface $statusChangeTime): self
    {
        $this->statusChangeTime = $statusChangeTime;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatusComment(): ?string
    {
        return $this->statusComment;
    }

    /**
     * @param string|null $statusComment
     * @return OrderStatusChangeLog
     */
    public function setStatusComment(?string $statusComment): self
    {
        $this->statusComment = $statusComment;

        return $this;
    }
}
