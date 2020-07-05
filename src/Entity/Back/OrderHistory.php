<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_order_history`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderHistoryRepository")
 */
class OrderHistory
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var int|null $orderNum
     * @ORM\Column(type="integer", name="`order_num`")
     */
    protected $orderNum;

    /**
     * @var int|null $customerId
     * @ORM\Column(type="integer", name="`customerID`")
     */
    protected $customerId;

    /**
     * @var DateTimeInterface|null $date
     * @ORM\Column(type="datetime", name="`date`")
     */
    protected $date;

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
    public function getOrderNum(): ?int
    {
        return $this->orderNum;
    }

    /**
     * @param int $orderNum
     * @return OrderHistory
     */
    public function setOrderNum(int $orderNum): self
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return OrderHistory
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     * @return OrderHistory
     */
    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
