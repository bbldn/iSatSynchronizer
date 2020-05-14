<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRecurringTransactionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderRecurringTransaction
{
    /**
     * @var int|null $orderRecurringTransactionId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_recurring_transaction_id`")
     */
    protected $orderRecurringTransactionId;

    /**
     * @var int|null $orderRecurringId
     * @ORM\Column(type="integer", name="`order_recurring_id`")
     */
    protected $orderRecurringId;

    /**
     * @var string|null $reference
     * @ORM\Column(type="string", name="`reference`", length=255)
     */
    protected $reference;

    /**
     * @var string|null $type
     * @ORM\Column(type="string", name="`type`", length=255)
     */
    protected $type;

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
     * @return int|null
     */
    public function getOrderRecurringTransactionId(): ?int
    {
        return $this->orderRecurringTransactionId;
    }

    /**
     * @param int $orderRecurringTransactionId
     * @return OrderRecurringTransaction
     */
    public function setOrderRecurringTransactionId(int $orderRecurringTransactionId): self
    {
        $this->orderRecurringTransactionId = $orderRecurringTransactionId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderRecurringId(): ?int
    {
        return $this->orderRecurringId;
    }

    /**
     * @param int $orderRecurringId
     * @return OrderRecurringTransaction
     */
    public function setOrderRecurringId(int $orderRecurringId): self
    {
        $this->orderRecurringId = $orderRecurringId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return OrderRecurringTransaction
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return OrderRecurringTransaction
     */
    public function setType(string $type): self
    {
        $this->type = $type;

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
     * @return OrderRecurringTransaction
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

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
     * @return OrderRecurringTransaction
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
