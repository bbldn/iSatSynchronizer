<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_transaction`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerTransactionRepository")
 */
class CustomerTransaction
{
    /**
     * @var int|null $customerTransactionId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_transaction_id`")
     */
    protected $customerTransactionId;

    /**
     * @var int|null $customerId
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`", length=255)
     */
    protected $description;

    /**
     * @var float|null $amount
     * @ORM\Column(type="float", name="`amount`")
     */
    protected $amount;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

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

    /**
     * @return int|null
     */
    public function getCustomerTransactionId(): ?int
    {
        return $this->customerTransactionId;
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
     * @return CustomerTransaction
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
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
     * @return CustomerTransaction
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CustomerTransaction
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CustomerTransaction
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

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
     * @return CustomerTransaction
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
