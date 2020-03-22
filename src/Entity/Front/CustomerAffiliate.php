<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_affiliate`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerAffiliateRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerAffiliate
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", name="`company`", length=40)
     */
    private $company;

    /**
     * @ORM\Column(type="string", name="`website`", length=255)
     */
    private $website;

    /**
     * @ORM\Column(type="string", name="`tracking`", length=64)
     */
    private $tracking;

    /**
     * @ORM\Column(type="float", name="`commission`")
     */
    private $commission;

    /**
     * @ORM\Column(type="string", name="`tax`", length=64)
     */
    private $tax;

    /**
     * @ORM\Column(type="string", name="`payment`", length=6)
     */
    private $payment;

    /**
     * @ORM\Column(type="string", name="`cheque`", length=100)
     */
    private $cheque;

    /**
     * @ORM\Column(type="string", name="`paypal`", length=64)
     */
    private $payPal;

    /**
     * @ORM\Column(type="string", name="`bank_name`", length=64)
     */
    private $bankName;

    /**
     * @ORM\Column(type="string", name="`bank_branch_number`", length=64)
     */
    private $bankBranchNumber;

    /**
     * @ORM\Column(type="string", name="`bank_swift_code`", length=64)
     */
    private $bankSwiftCode;

    /**
     * @ORM\Column(type="string", name="`bank_account_name`", length=64)
     */
    private $bankAccountName;

    /**
     * @ORM\Column(type="string", name="`bank_account_number`", length=64)
     */
    private $bankAccountNumber;

    /**
     * @ORM\Column(type="string", name="`custom_field`", length=255)
     */
    private $customField;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getTracking(): ?string
    {
        return $this->tracking;
    }

    public function setTracking(string $tracking): self
    {
        $this->tracking = $tracking;

        return $this;
    }

    public function getCommission(): ?float
    {
        return $this->commission;
    }

    public function setCommission(float $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getCheque(): ?string
    {
        return $this->cheque;
    }

    public function setCheque(string $cheque): self
    {
        $this->cheque = $cheque;

        return $this;
    }

    public function getPayPal(): ?string
    {
        return $this->payPal;
    }

    public function setPayPal(string $payPal): self
    {
        $this->payPal = $payPal;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getBankBranchNumber(): ?string
    {
        return $this->bankBranchNumber;
    }

    public function setBankBranchNumber(string $bankBranchNumber): self
    {
        $this->bankBranchNumber = $bankBranchNumber;

        return $this;
    }

    public function getBankSwiftCode(): ?string
    {
        return $this->bankSwiftCode;
    }

    public function setBankSwiftCode(string $bankSwiftCode): self
    {
        $this->bankSwiftCode = $bankSwiftCode;

        return $this;
    }

    public function getBankAccountName(): ?string
    {
        return $this->bankAccountName;
    }

    public function setBankAccountName(string $bankAccountName): self
    {
        $this->bankAccountName = $bankAccountName;

        return $this;
    }

    public function getBankAccountNumber(): ?string
    {
        return $this->bankAccountNumber;
    }

    public function setBankAccountNumber(string $bankAccountNumber): self
    {
        $this->bankAccountNumber = $bankAccountNumber;

        return $this;
    }

    public function getCustomField(): ?string
    {
        return $this->customField;
    }

    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

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
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}