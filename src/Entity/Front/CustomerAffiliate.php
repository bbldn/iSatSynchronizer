<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_affiliate`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerAffiliateRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerAffiliate
{
    /**
     * @var int|null $customerId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var string|null $company
     * @ORM\Column(type="string", name="`company`", length=40)
     */
    protected $company;

    /**
     * @var string|null $website
     * @ORM\Column(type="string", name="`website`", length=255)
     */
    protected $website;

    /**
     * @var string|null $tracking
     * @ORM\Column(type="string", name="`tracking`", length=64)
     */
    protected $tracking;

    /**
     * @var float|null $commission
     * @ORM\Column(type="float", name="`commission`")
     */
    protected $commission = 0.0;

    /**
     * @var string|null $tax
     * @ORM\Column(type="string", name="`tax`", length=64)
     */
    protected $tax;

    /**
     * @var string|null $payment
     * @ORM\Column(type="string", name="`payment`", length=6)
     */
    protected $payment;

    /**
     * @var string|null $cheque
     * @ORM\Column(type="string", name="`cheque`", length=100)
     */
    protected $cheque;

    /**
     * @var string|null $payPal
     * @ORM\Column(type="string", name="`paypal`", length=64)
     */
    protected $payPal;

    /**
     * @var string|null $bankName
     * @ORM\Column(type="string", name="`bank_name`", length=64)
     */
    protected $bankName;

    /**
     * @var string|null $bankBranchNumber
     * @ORM\Column(type="string", name="`bank_branch_number`", length=64)
     */
    protected $bankBranchNumber;

    /**
     * @var string|null $bankSwiftCode
     * @ORM\Column(type="string", name="`bank_swift_code`", length=64)
     */
    protected $bankSwiftCode;

    /**
     * @var string|null $bankAccountName
     * @ORM\Column(type="string", name="`bank_account_name`", length=64)
     */
    protected $bankAccountName;

    /**
     * @var string|null $bankAccountNumber
     * @ORM\Column(type="string", name="`bank_account_number`", length=64)
     */
    protected $bankAccountNumber;

    /**
     * @var string|null $customField
     * @ORM\Column(type="string", name="`custom_field`", length=255)
     */
    protected $customField;

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
     * @param string $company
     * @param string $website
     * @param string $tracking
     * @param float $commission
     * @param string $tax
     * @param string $payment
     * @param string $cheque
     * @param string $payPal
     * @param string $bankName
     * @param string $bankBranchNumber
     * @param string $bankSwiftCode
     * @param string $bankAccountName
     * @param string $bankAccountNumber
     * @param string $customField
     * @param bool $status
     */
    public function fill(
        string $company,
        string $website,
        string $tracking,
        float $commission,
        string $tax,
        string $payment,
        string $cheque,
        string $payPal,
        string $bankName,
        string $bankBranchNumber,
        string $bankSwiftCode,
        string $bankAccountName,
        string $bankAccountNumber,
        string $customField,
        bool $status
    )
    {
        $this->company = $company;
        $this->website = $website;
        $this->tracking = $tracking;
        $this->commission = $commission;
        $this->tax = $tax;
        $this->payment = $payment;
        $this->cheque = $cheque;
        $this->payPal = $payPal;
        $this->bankName = $bankName;
        $this->bankBranchNumber = $bankBranchNumber;
        $this->bankSwiftCode = $bankSwiftCode;
        $this->bankAccountName = $bankAccountName;
        $this->bankAccountNumber = $bankAccountNumber;
        $this->customField = $customField;
        $this->status = $status;
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
     * @return CustomerAffiliate
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return CustomerAffiliate
     */
    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string $website
     * @return CustomerAffiliate
     */
    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTracking(): ?string
    {
        return $this->tracking;
    }

    /**
     * @param string $tracking
     * @return CustomerAffiliate
     */
    public function setTracking(string $tracking): self
    {
        $this->tracking = $tracking;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getCommission(): ?float
    {
        return $this->commission;
    }

    /**
     * @param float $commission
     * @return CustomerAffiliate
     */
    public function setCommission(float $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTax(): ?string
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     * @return CustomerAffiliate
     */
    public function setTax(string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayment(): ?string
    {
        return $this->payment;
    }

    /**
     * @param string $payment
     * @return CustomerAffiliate
     */
    public function setPayment(string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCheque(): ?string
    {
        return $this->cheque;
    }

    /**
     * @param string $cheque
     * @return CustomerAffiliate
     */
    public function setCheque(string $cheque): self
    {
        $this->cheque = $cheque;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayPal(): ?string
    {
        return $this->payPal;
    }

    /**
     * @param string $payPal
     * @return CustomerAffiliate
     */
    public function setPayPal(string $payPal): self
    {
        $this->payPal = $payPal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     * @return CustomerAffiliate
     */
    public function setBankName(string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankBranchNumber(): ?string
    {
        return $this->bankBranchNumber;
    }

    /**
     * @param string $bankBranchNumber
     * @return CustomerAffiliate
     */
    public function setBankBranchNumber(string $bankBranchNumber): self
    {
        $this->bankBranchNumber = $bankBranchNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankSwiftCode(): ?string
    {
        return $this->bankSwiftCode;
    }

    /**
     * @param string $bankSwiftCode
     * @return CustomerAffiliate
     */
    public function setBankSwiftCode(string $bankSwiftCode): self
    {
        $this->bankSwiftCode = $bankSwiftCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankAccountName(): ?string
    {
        return $this->bankAccountName;
    }

    /**
     * @param string $bankAccountName
     * @return CustomerAffiliate
     */
    public function setBankAccountName(string $bankAccountName): self
    {
        $this->bankAccountName = $bankAccountName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankAccountNumber(): ?string
    {
        return $this->bankAccountNumber;
    }

    /**
     * @param string $bankAccountNumber
     * @return CustomerAffiliate
     */
    public function setBankAccountNumber(string $bankAccountNumber): self
    {
        $this->bankAccountNumber = $bankAccountNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomField(): ?string
    {
        return $this->customField;
    }

    /**
     * @param string $customField
     * @return CustomerAffiliate
     */
    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

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
     * @return CustomerAffiliate
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
     * @return CustomerAffiliate
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new DateTime('now'));
        }
    }
}
