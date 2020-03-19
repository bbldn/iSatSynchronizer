<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_history`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderHistoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_num`")
     */
    private $orderNum;

    /**
     * @ORM\Column(type="integer", name="`customerID`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="datetime", name="`date`")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNum(): ?int
    {
        return $this->orderNum;
    }

    public function setOrderNum(int $orderNum): self
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        $this->setDate(new \DateTime());
    }
}
