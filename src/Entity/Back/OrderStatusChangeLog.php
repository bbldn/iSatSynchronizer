<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_status_changelog`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderStatusChangeLogRepository")
 */
class OrderStatusChangeLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`orderID`", nullable=true)
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", name="`status_name`", length=255, nullable=true)
     */
    private $statusName;

    /**
     * @ORM\Column(type="datetime", name="`status_change_time`", nullable=true)
     */
    private $statusChangeTime;

    /**
     * @ORM\Column(type="string", name="`status_comment`", length=255, nullable=true)
     */
    private $statusComment;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    public function setStatusName(?string $statusName): self
    {
        $this->statusName = $statusName;

        return $this;
    }

    public function getStatusChangeTime(): ?\DateTimeInterface
    {
        return $this->statusChangeTime;
    }

    public function setStatusChangeTime(?\DateTimeInterface $statusChangeTime): self
    {
        $this->statusChangeTime = $statusChangeTime;

        return $this;
    }

    public function getStatusComment(): ?string
    {
        return $this->statusComment;
    }

    public function setStatusComment(?string $statusComment): self
    {
        $this->statusComment = $statusComment;

        return $this;
    }
}
