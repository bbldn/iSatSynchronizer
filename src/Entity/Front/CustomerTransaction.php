<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_transaction`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerTransactionRepository")
 */
class CustomerTransaction extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_transaction_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", name="`description`", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float", name="`amount`")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @param int $customerId
     * @param int $orderId
     * @param string $description
     * @param int $amount
     */
    public function fill(
        int $customerId,
        int $orderId,
        string $description,
        int $amount
    )
    {
        $this->customerId = $customerId;
        $this->orderId = $orderId;
        $this->description = $description;
        $this->amount = $amount;
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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

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
