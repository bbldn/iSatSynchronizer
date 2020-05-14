<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRecurringRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderRecurring
{
    /**
     * @var int|null $orderRecurringId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_recurring_id`")
     */
    protected $orderRecurringId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var string|null $reference
     * @ORM\Column(type="string", name="`reference`", length=255)
     */
    protected $reference;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var string|null $productName
     * @ORM\Column(type="string", name="`product_name`", length=255)
     */
    protected $productName;

    /**
     * @var int|null $productQuantity
     * @ORM\Column(type="integer", name="`product_quantity`")
     */
    protected $productQuantity;

    /**
     * @var int|null $recurringId
     * @ORM\Column(type="integer", name="`recurring_id`")
     */
    protected $recurringId;

    /**
     * @var string|null $recurringName
     * @ORM\Column(type="string", name="`recurring_name`", length=255)
     */
    protected $recurringName;

    /**
     * @var string|null $recurringDescription
     * @ORM\Column(type="string", name="`recurring_description`", length=255)
     */
    protected $recurringDescription;

    /**
     * @var string|null $recurringFrequency
     * @ORM\Column(type="string", name="`recurring_frequency`", length=25)
     */
    protected $recurringFrequency;

    /**
     * @var int|null $recurringCycle
     * @ORM\Column(type="smallint", name="`recurring_cycle`")
     */
    protected $recurringCycle;

    /**
     * @var int|null $recurringDuration
     * @ORM\Column(type="smallint", name="`recurring_duration`")
     */
    protected $recurringDuration;

    /**
     * @var float|null $recurringPrice
     * @ORM\Column(type="float", name="`recurring_price`")
     */
    protected $recurringPrice;

    /**
     * @var bool|null $trial
     * @ORM\Column(type="boolean", name="`trial`")
     */
    protected $trial;

    /**
     * @var string|null $trialFrequency
     * @ORM\Column(type="string", name="`trial_frequency`", length=25)
     */
    protected $trialFrequency;

    /**
     * @var int|null $trialCycle
     * @ORM\Column(type="smallint", name="`trial_cycle`")
     */
    protected $trialCycle;

    /**
     * @var int|null $trialDuration
     * @ORM\Column(type="smallint", name="`trial_duration`")
     */
    protected $trialDuration;

    /**
     * @var float|null $trialPrice
     * @ORM\Column(type="float", name="`trial_price`")
     */
    protected $trialPrice;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @var DateTimeInterface|null $dateAdded
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

    /**
     * @return int|null
     */
    public function getOrderRecurringId(): ?int
    {
        return $this->orderRecurringId;
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
     * @return OrderRecurring
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

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
     * @return OrderRecurring
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return OrderRecurring
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     * @return OrderRecurring
     */
    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    /**
     * @param int $productQuantity
     * @return OrderRecurring
     */
    public function setProductQuantity(int $productQuantity): self
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecurringId(): ?int
    {
        return $this->recurringId;
    }

    /**
     * @param int $recurringId
     * @return OrderRecurring
     */
    public function setRecurringId(int $recurringId): self
    {
        $this->recurringId = $recurringId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecurringName(): ?string
    {
        return $this->recurringName;
    }

    /**
     * @param string $recurringName
     * @return OrderRecurring
     */
    public function setRecurringName(string $recurringName): self
    {
        $this->recurringName = $recurringName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecurringDescription(): ?string
    {
        return $this->recurringDescription;
    }

    /**
     * @param string $recurringDescription
     * @return OrderRecurring
     */
    public function setRecurringDescription(string $recurringDescription): self
    {
        $this->recurringDescription = $recurringDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecurringFrequency(): ?string
    {
        return $this->recurringFrequency;
    }

    /**
     * @param string $recurringFrequency
     * @return OrderRecurring
     */
    public function setRecurringFrequency(string $recurringFrequency): self
    {
        $this->recurringFrequency = $recurringFrequency;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecurringCycle(): ?int
    {
        return $this->recurringCycle;
    }

    /**
     * @param int $recurringCycle
     * @return OrderRecurring
     */
    public function setRecurringCycle(int $recurringCycle): self
    {
        $this->recurringCycle = $recurringCycle;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecurringDuration(): ?int
    {
        return $this->recurringDuration;
    }

    /**
     * @param int $recurringDuration
     * @return OrderRecurring
     */
    public function setRecurringDuration(int $recurringDuration): self
    {
        $this->recurringDuration = $recurringDuration;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getRecurringPrice(): ?float
    {
        return $this->recurringPrice;
    }

    /**
     * @param float $recurringPrice
     * @return OrderRecurring
     */
    public function setRecurringPrice(float $recurringPrice): self
    {
        $this->recurringPrice = $recurringPrice;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTrial(): ?bool
    {
        return $this->trial;
    }

    /**
     * @param bool $trial
     * @return OrderRecurring
     */
    public function setTrial(bool $trial): self
    {
        $this->trial = $trial;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrialFrequency(): ?string
    {
        return $this->trialFrequency;
    }

    /**
     * @param string $trialFrequency
     * @return OrderRecurring
     */
    public function setTrialFrequency(string $trialFrequency): self
    {
        $this->trialFrequency = $trialFrequency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrialCycle(): ?string
    {
        return $this->trialCycle;
    }

    /**
     * @param string $trialCycle
     * @return OrderRecurring
     */
    public function setTrialCycle(string $trialCycle): self
    {
        $this->trialCycle = $trialCycle;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTrialDuration(): ?int
    {
        return $this->trialDuration;
    }

    /**
     * @param int $trialDuration
     * @return OrderRecurring
     */
    public function setTrialDuration(int $trialDuration): self
    {
        $this->trialDuration = $trialDuration;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTrialPrice(): ?float
    {
        return $this->trialPrice;
    }

    /**
     * @param float $trialPrice
     * @return OrderRecurring
     */
    public function setTrialPrice(float $trialPrice): self
    {
        $this->trialPrice = $trialPrice;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return OrderRecurring
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
     * @return OrderRecurring
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
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
            $this->setDateAdded(new DateTime('now'));
        }
    }
}
