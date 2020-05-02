<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRecurringRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderRecurring
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_recurring_id`")
     */
    protected $orderRecurringId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @ORM\Column(type="string", name="`reference`", length=255)
     */
    protected $reference;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="string", name="`product_name`", length=255)
     */
    protected $productName;

    /**
     * @ORM\Column(type="integer", name="`product_quantity`")
     */
    protected $productQuantity;

    /**
     * @ORM\Column(type="integer", name="`recurring_id`")
     */
    protected $recurringId;

    /**
     * @ORM\Column(type="string", name="`recurring_name`", length=255)
     */
    protected $recurringName;

    /**
     * @ORM\Column(type="string", name="`recurring_description`", length=255)
     */
    protected $recurringDescription;

    /**
     * @ORM\Column(type="string", name="`recurring_frequency`", length=25)
     */
    protected $recurringFrequency;

    /**
     * @ORM\Column(type="smallint", name="`recurring_cycle`")
     */
    protected $recurringCycle;

    /**
     * @ORM\Column(type="smallint", name="`recurring_duration`")
     */
    protected $recurringDuration;

    /**
     * @ORM\Column(type="float", name="`recurring_price`")
     */
    protected $recurringPrice;

    /**
     * @ORM\Column(type="boolean", name="`trial`")
     */
    protected $trial;

    /**
     * @ORM\Column(type="string", name="`trial_frequency`", length=25)
     */
    protected $trialFrequency;

    /**
     * @ORM\Column(type="smallint", name="`trial_cycle`")
     */
    protected $trialCycle;

    /**
     * @ORM\Column(type="smallint", name="`trial_duration`")
     */
    protected $trialDuration;

    /**
     * @ORM\Column(type="float", name="`trial_price`")
     */
    protected $trialPrice;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @param int $orderId
     * @param string $reference
     * @param int $productId
     * @param string $productName
     * @param int $productQuantity
     * @param int $recurringId
     * @param string $recurringName
     * @param string $recurringDescription
     * @param string $recurringFrequency
     * @param int $recurringCycle
     * @param int $recurringDuration
     * @param float $recurringPrice
     * @param bool $trial
     * @param string $trialFrequency
     * @param int $trialCycle
     * @param int $trialDuration
     * @param float $trialPrice
     * @param bool $status
     */
    public function fill(
        int $orderId,
        string $reference,
        int $productId,
        string $productName,
        int $productQuantity,
        int $recurringId,
        string $recurringName,
        string $recurringDescription,
        string $recurringFrequency,
        int $recurringCycle,
        int $recurringDuration,
        float $recurringPrice,
        bool $trial,
        string $trialFrequency,
        int $trialCycle,
        int $trialDuration,
        float $trialPrice,
        bool $status
    )
    {
        $this->orderId = $orderId;
        $this->reference = $reference;
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productQuantity = $productQuantity;
        $this->recurringId = $recurringId;
        $this->recurringName = $recurringName;
        $this->recurringDescription = $recurringDescription;
        $this->recurringFrequency = $recurringFrequency;
        $this->recurringCycle = $recurringCycle;
        $this->recurringDuration = $recurringDuration;
        $this->recurringPrice = $recurringPrice;
        $this->trial = $trial;
        $this->trialFrequency = $trialFrequency;
        $this->trialCycle = $trialCycle;
        $this->trialDuration = $trialDuration;
        $this->trialPrice = $trialPrice;
        $this->status = $status;
    }

    public function getOrderRecurringId(): ?int
    {
        return $this->orderRecurringId;
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): self
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    public function getRecurringId(): ?int
    {
        return $this->recurringId;
    }

    public function setRecurringId(int $recurringId): self
    {
        $this->recurringId = $recurringId;

        return $this;
    }

    public function getRecurringName(): ?string
    {
        return $this->recurringName;
    }

    public function setRecurringName(string $recurringName): self
    {
        $this->recurringName = $recurringName;

        return $this;
    }

    public function getRecurringDescription(): ?string
    {
        return $this->recurringDescription;
    }

    public function setRecurringDescription(string $recurringDescription): self
    {
        $this->recurringDescription = $recurringDescription;

        return $this;
    }

    public function getRecurringFrequency(): ?string
    {
        return $this->recurringFrequency;
    }

    public function setRecurringFrequency(string $recurringFrequency): self
    {
        $this->recurringFrequency = $recurringFrequency;

        return $this;
    }

    public function getRecurringCycle(): ?int
    {
        return $this->recurringCycle;
    }

    public function setRecurringCycle(int $recurringCycle): self
    {
        $this->recurringCycle = $recurringCycle;

        return $this;
    }

    public function getRecurringDuration(): ?int
    {
        return $this->recurringDuration;
    }

    public function setRecurringDuration(int $recurringDuration): self
    {
        $this->recurringDuration = $recurringDuration;

        return $this;
    }

    public function getRecurringPrice(): ?float
    {
        return $this->recurringPrice;
    }

    public function setRecurringPrice(float $recurringPrice): self
    {
        $this->recurringPrice = $recurringPrice;

        return $this;
    }

    public function getTrial(): ?bool
    {
        return $this->trial;
    }

    public function setTrial(bool $trial): self
    {
        $this->trial = $trial;

        return $this;
    }

    public function getTrialFrequency(): ?string
    {
        return $this->trialFrequency;
    }

    public function setTrialFrequency(string $trialFrequency): self
    {
        $this->trialFrequency = $trialFrequency;

        return $this;
    }

    public function getTrialCycle(): ?string
    {
        return $this->trialCycle;
    }

    public function setTrialCycle(string $trialCycle): self
    {
        $this->trialCycle = $trialCycle;

        return $this;
    }

    public function getTrialDuration(): ?int
    {
        return $this->trialDuration;
    }

    public function setTrialDuration(int $trialDuration): self
    {
        $this->trialDuration = $trialDuration;

        return $this;
    }

    public function getTrialPrice(): ?float
    {
        return $this->trialPrice;
    }

    public function setTrialPrice(float $trialPrice): self
    {
        $this->trialPrice = $trialPrice;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
