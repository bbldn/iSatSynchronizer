<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRecurringTransactionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderRecurringTransaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_recurring_transaction_id`")
     */
    protected $orderRecurringTransactionId;

    /**
     * @ORM\Column(type="integer", name="`order_recurring_id`")
     */
    protected $orderRecurringId;

    /**
     * @ORM\Column(type="string", name="`reference`", length=255)
     */
    protected $reference;

    /**
     * @ORM\Column(type="string", name="`type`", length=255)
     */
    protected $type;

    /**
     * @ORM\Column(type="float", name="`amount`")
     */
    protected $amount;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @param int $orderRecurringId
     * @param string $reference
     * @param string $type
     * @param int $amount
     */
    public function fill(
        int $orderRecurringId,
        string $reference,
        string $type,
        int $amount
    )
    {
        $this->orderRecurringId = $orderRecurringId;
        $this->reference = $reference;
        $this->type = $type;
        $this->amount = $amount;
    }

    public function getOrderRecurringTransactionId(): ?int
    {
        return $this->orderRecurringTransactionId;
    }

    public function setOrderRecurringTransactionId(int $orderRecurringTransactionId): self
    {
        $this->orderRecurringTransactionId = $orderRecurringTransactionId;

        return $this;
    }

    public function getOrderRecurringId(): ?int
    {
        return $this->orderRecurringId;
    }

    public function setOrderRecurringId(int $orderRecurringId): self
    {
        $this->orderRecurringId = $orderRecurringId;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
