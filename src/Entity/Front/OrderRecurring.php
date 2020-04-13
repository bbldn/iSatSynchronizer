<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRecurringRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderRecurring extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_recurring_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", name="`reference`", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`product_name`", length=255)
     */
    private $productName;

    /**
     * @ORM\Column(type="integer", name="`product_quantity`")
     */
    private $productQuantity;

    /**
     * @ORM\Column(type="integer", name="`recurring_id`")
     */
    private $recurringId;

    /**
     * @ORM\Column(type="string", name="`recurring_name`", length=255)
     */
    private $recurringName;

    /**
     * @ORM\Column(type="string", name="`recurring_description`", length=255)
     */
    private $recurringDescription;

    /**
     * @ORM\Column(type="string", name="`recurring_frequency`", length=25)
     */
    private $recurringFrequency;

    /**
     * @ORM\Column(type="smallint", name="`recurring_cycle`")
     */
    private $recurringCycle;

    /**
     * @ORM\Column(type="smallint", name="`recurring_duration`")
     */
    private $recurringDuration;

    /**
     * @ORM\Column(type="float", name="`recurring_price`")
     */
    private $recurringPrice;

    /**
     * @ORM\Column(type="boolean", name="`trial`")
     */
    private $trial;

    /**
     * @ORM\Column(type="string", name="`trial_frequency`", length=25)
     */
    private $trialFrequency;

    /**
     * @ORM\Column(type="smallint", name="`trial_cycle`")
     */
    private $trialCycle;

    /**
     * @ORM\Column(type="smallint", name="`trial_duration`")
     */
    private $trialDuration;

    /**
     * @ORM\Column(type="float", name="`trial_price`")
     */
    private $trialPrice;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

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
}
