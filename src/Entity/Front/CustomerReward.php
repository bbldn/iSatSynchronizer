<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_reward`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerRewardRepository")
 */
class CustomerReward
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_reward_id`")
     */
    protected $customerRewardId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId = 0;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId = 0;

    /**
     * @ORM\Column(type="string", name="`description`")
     */
    protected $description;

    /**
     * @ORM\Column(type="integer", name="`points`")
     */
    protected $points = 0;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @param int $customerId
     * @param int $orderId
     * @param string $description
     * @param int $points
     */
    public function fill(
        int $customerId,
        int $orderId,
        string $description,
        int $points
    )
    {
        $this->customerId = $customerId;
        $this->orderId = $orderId;
        $this->description = $description;
        $this->points = $points;
    }

    public function getCustomerRewardId(): ?int
    {
        return $this->customerRewardId;
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

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

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
}
