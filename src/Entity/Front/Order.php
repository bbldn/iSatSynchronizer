<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="integer", name="`invoice_no`")
     */
    private $invoiceNo = 0;

    /**
     * @ORM\Column(type="string", name="`invoice_prefix`", length=26)
     */
    private $invoicePrefix;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    private $storeId = 0;

    /**
     * @ORM\Column(type="string", name="`store_name`", length=64)
     */
    private $storeName;

    /**
     * @ORM\Column(type="string", name="`store_url`", length=255)
     */
    private $storeUrl;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId = 0;

    /**
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    private $customerGroupId = 0;

    /**
     * @ORM\Column(type="string", name="`firstname`", length=32)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="`lastname`", length=32)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", name="`email`", length=96)
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="`telephone`", length=32)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", name="`fax`", length=32)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", name="`custom_field`", length=255)
     */
    private $customField;

    /**
     * @ORM\Column(type="string", name="`payment_firstname`", length=32)
     */
    private $paymentFirstName;

    /**
     * @ORM\Column(type="string", name="`payment_lastname`", length=32)
     */
    private $paymentLastName;

    /**
     * @ORM\Column(type="string", name="`payment_company`", length=60)
     */
    private $paymentCompany;

    /**
     * @ORM\Column(type="string", name="`payment_address_1`", length=128)
     */
    private $paymentAddress1;

    /**
     * @ORM\Column(type="string", name="`payment_address_2`", length=128)
     */
    private $paymentAddress2;

    /**
     * @ORM\Column(type="string", name="`payment_city`", length=128)
     */
    private $paymentCity;

    /**
     * @ORM\Column(type="string", name="`payment_postcode`", length=10)
     */
    private $paymentPostCode;

    /**
     * @ORM\Column(type="string", name="`payment_country`", length=128)
     */
    private $paymentCountry;

    /**
     * @ORM\Column(type="integer", name="`payment_country_id`")
     */
    private $paymentCountryId;

    /**
     * @ORM\Column(type="string", name="`payment_zone`", length=128)
     */
    private $paymentZone;

    /**
     * @ORM\Column(type="integer", name="`payment_zone_id`")
     */
    private $paymentZoneId;

    /**
     * @ORM\Column(type="string", name="`payment_address_format`", length=255)
     */
    private $paymentAddressFormat;

    /**
     * @ORM\Column(type="string", name="`payment_custom_field`", length=255)
     */
    private $paymentCustomField;

    /**
     * @ORM\Column(type="string", name="`payment_method`", length=128)
     */
    private $paymentMethod;

    /**
     * @ORM\Column(type="string", name="`payment_code`", length=128)
     */
    private $paymentCode;

    /**
     * @ORM\Column(type="string", name="`shipping_firstname`", length=32)
     */
    private $shippingFirstName;

    /**
     * @ORM\Column(type="string", name="`shipping_lastname`", length=32)
     */
    private $shippingLastName;

    /**
     * @ORM\Column(type="string", name="`shipping_company`", length=40)
     */
    private $shippingCompany;

    /**
     * @ORM\Column(type="string", name="`shipping_address_1`", length=128)
     */
    private $shippingAddress1;

    /**
     * @ORM\Column(type="string", name="`shipping_address_2`", length=128)
     */
    private $shippingAddress2;

    /**
     * @ORM\Column(type="string", name="`shipping_city`", length=128)
     */
    private $shippingCity;

    /**
     * @ORM\Column(type="string", name="`shipping_postcode`", length=10)
     */
    private $shippingPostCode;

    /**
     * @ORM\Column(type="string", name="`shipping_country`", length=128)
     */
    private $shippingCountry;

    /**
     * @ORM\Column(type="integer", name="`shipping_country_id`")
     */
    private $shippingCountryId;

    /**
     * @ORM\Column(type="string", name="`shipping_zone`", length=128)
     */
    private $shippingZone;

    /**
     * @ORM\Column(type="integer", name="`shipping_zone_id`")
     */
    private $shippingZoneId;

    /**
     * @ORM\Column(type="string", name="`shipping_address_format`", length=255)
     */
    private $shippingAddressFormat;

    /**
     * @ORM\Column(type="string", name="`shipping_custom_field`", length=255)
     */
    private $shippingCustomField;

    /**
     * @ORM\Column(type="string", name="`shipping_method`", length=128)
     */
    private $shippingMethod;

    /**
     * @ORM\Column(type="string", name="`shipping_code`", length=128)
     */
    private $shippingCode;

    /**
     * @ORM\Column(type="string", name="`comment`", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="float", name="`total`")
     */
    private $total = 0.0;

    /**
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    private $orderStatusId = 0;

    /**
     * @ORM\Column(type="integer", name="`affiliate_id`")
     */
    private $affiliateId;

    /**
     * @ORM\Column(type="float", name="`commission`")
     */
    private $commission;

    /**
     * @ORM\Column(type="integer", name="`marketing_id`")
     */
    private $marketingId;

    /**
     * @ORM\Column(type="string", name="`tracking`", length=64)
     */
    private $tracking;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="integer", name="`currency_id`")
     */
    private $currencyId;

    /**
     * @ORM\Column(type="string", name="`currency_code`", length=3)
     */
    private $currencyCode;

    /**
     * @ORM\Column(type="float", name="`currency_value`")
     */
    private $currencyValue = 1.0;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", name="`forwarded_ip`", length=255)
     */
    private $forwardedIp;

    /**
     * @ORM\Column(type="string", name="`user_agent`", length=255)
     */
    private $userAgent;

    /**
     * @ORM\Column(type="string", name="`accept_language`", length=255)
     */
    private $acceptLanguage;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    private $dateModified;

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getInvoiceNo(): ?int
    {
        return $this->invoiceNo;
    }

    public function setInvoiceNo(int $invoiceNo): self
    {
        $this->invoiceNo = $invoiceNo;

        return $this;
    }

    public function getInvoicePrefix(): ?string
    {
        return $this->invoicePrefix;
    }

    public function setInvoicePrefix(string $invoicePrefix): self
    {
        $this->invoicePrefix = $invoicePrefix;

        return $this;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    public function setStoreName(string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }

    public function getStoreUrl(): ?string
    {
        return $this->storeUrl;
    }

    public function setStoreUrl(string $storeUrl): self
    {
        $this->storeUrl = $storeUrl;

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

    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

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

    public function getPaymentFirstName(): ?string
    {
        return $this->paymentFirstName;
    }

    public function setPaymentFirstName(string $paymentFirstName): self
    {
        $this->paymentFirstName = $paymentFirstName;

        return $this;
    }

    public function getPaymentLastName(): ?string
    {
        return $this->paymentLastName;
    }

    public function setPaymentLastName(string $paymentLastName): self
    {
        $this->paymentLastName = $paymentLastName;

        return $this;
    }

    public function getPaymentCompany(): ?string
    {
        return $this->paymentCompany;
    }

    public function setPaymentCompany(string $paymentCompany): self
    {
        $this->paymentCompany = $paymentCompany;

        return $this;
    }

    public function getPaymentAddress1(): ?string
    {
        return $this->paymentAddress1;
    }

    public function setPaymentAddress1(string $paymentAddress1): self
    {
        $this->paymentAddress1 = $paymentAddress1;

        return $this;
    }

    public function getPaymentAddress2(): ?string
    {
        return $this->paymentAddress2;
    }

    public function setPaymentAddress2(string $paymentAddress2): self
    {
        $this->paymentAddress2 = $paymentAddress2;

        return $this;
    }

    public function getPaymentCity(): ?string
    {
        return $this->paymentCity;
    }

    public function setPaymentCity(string $paymentCity): self
    {
        $this->paymentCity = $paymentCity;

        return $this;
    }

    public function getPaymentPostCode(): ?string
    {
        return $this->paymentPostCode;
    }

    public function setPaymentPostCode(string $paymentPostCode): self
    {
        $this->paymentPostCode = $paymentPostCode;

        return $this;
    }

    public function getPaymentCountry(): ?string
    {
        return $this->paymentCountry;
    }

    public function setPaymentCountry(string $paymentCountry): self
    {
        $this->paymentCountry = $paymentCountry;

        return $this;
    }

    public function getPaymentCountryId(): ?int
    {
        return $this->paymentCountryId;
    }

    public function setPaymentCountryId(int $paymentCountryId): self
    {
        $this->paymentCountryId = $paymentCountryId;

        return $this;
    }

    public function getPaymentZone(): ?string
    {
        return $this->paymentZone;
    }

    public function setPaymentZone(string $paymentZone): self
    {
        $this->paymentZone = $paymentZone;

        return $this;
    }

    public function getPaymentZoneId(): ?int
    {
        return $this->paymentZoneId;
    }

    public function setPaymentZoneId(int $paymentZoneId): self
    {
        $this->paymentZoneId = $paymentZoneId;

        return $this;
    }

    public function getPaymentAddressFormat(): ?string
    {
        return $this->paymentAddressFormat;
    }

    public function setPaymentAddressFormat(string $paymentAddressFormat): self
    {
        $this->paymentAddressFormat = $paymentAddressFormat;

        return $this;
    }

    public function getPaymentCustomField(): ?string
    {
        return $this->paymentCustomField;
    }

    public function setPaymentCustomField(string $paymentCustomField): self
    {
        $this->paymentCustomField = $paymentCustomField;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getPaymentCode(): ?string
    {
        return $this->paymentCode;
    }

    public function setPaymentCode(string $paymentCode): self
    {
        $this->paymentCode = $paymentCode;

        return $this;
    }

    public function getShippingFirstName(): ?string
    {
        return $this->shippingFirstName;
    }

    public function setShippingFirstName(string $shippingFirstName): self
    {
        $this->shippingFirstName = $shippingFirstName;

        return $this;
    }

    public function getShippingLastName(): ?string
    {
        return $this->shippingLastName;
    }

    public function setShippingLastName(string $shippingLastName): self
    {
        $this->shippingLastName = $shippingLastName;

        return $this;
    }

    public function getShippingCompany(): ?string
    {
        return $this->shippingCompany;
    }

    public function setShippingCompany(string $shippingCompany): self
    {
        $this->shippingCompany = $shippingCompany;

        return $this;
    }

    public function getShippingAddress1(): ?string
    {
        return $this->shippingAddress1;
    }

    public function setShippingAddress1(string $shippingAddress1): self
    {
        $this->shippingAddress1 = $shippingAddress1;

        return $this;
    }

    public function getShippingAddress2(): ?string
    {
        return $this->shippingAddress2;
    }

    public function setShippingAddress2(string $shippingAddress2): self
    {
        $this->shippingAddress2 = $shippingAddress2;

        return $this;
    }

    public function getShippingCity(): ?string
    {
        return $this->shippingCity;
    }

    public function setShippingCity(string $shippingCity): self
    {
        $this->shippingCity = $shippingCity;

        return $this;
    }

    public function getShippingPostCode(): ?string
    {
        return $this->shippingPostCode;
    }

    public function setShippingPostCode(string $shippingPostCode): self
    {
        $this->shippingPostCode = $shippingPostCode;

        return $this;
    }

    public function getShippingCountry(): ?string
    {
        return $this->shippingCountry;
    }

    public function setShippingCountry(string $shippingCountry): self
    {
        $this->shippingCountry = $shippingCountry;

        return $this;
    }

    public function getShippingCountryId(): ?int
    {
        return $this->shippingCountryId;
    }

    public function setShippingCountryId(int $shippingCountryId): self
    {
        $this->shippingCountryId = $shippingCountryId;

        return $this;
    }

    public function getShippingZone(): ?string
    {
        return $this->shippingZone;
    }

    public function setShippingZone(string $shippingZone): self
    {
        $this->shippingZone = $shippingZone;

        return $this;
    }

    public function getShippingZoneId(): ?int
    {
        return $this->shippingZoneId;
    }

    public function setShippingZoneId(int $shippingZoneId): self
    {
        $this->shippingZoneId = $shippingZoneId;

        return $this;
    }

    public function getShippingAddressFormat(): ?string
    {
        return $this->shippingAddressFormat;
    }

    public function setShippingAddressFormat(string $shippingAddressFormat): self
    {
        $this->shippingAddressFormat = $shippingAddressFormat;

        return $this;
    }

    public function getShippingCustomField(): ?string
    {
        return $this->shippingCustomField;
    }

    public function setShippingCustomField(string $shippingCustomField): self
    {
        $this->shippingCustomField = $shippingCustomField;

        return $this;
    }

    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(string $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    public function getShippingCode(): ?string
    {
        return $this->shippingCode;
    }

    public function setShippingCode(string $shippingCode): self
    {
        $this->shippingCode = $shippingCode;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getOrderStatusId(): ?int
    {
        return $this->orderStatusId;
    }

    public function setOrderStatusId(int $orderStatusId): self
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    public function getAffiliateId(): ?int
    {
        return $this->affiliateId;
    }

    public function setAffiliateId(int $affiliateId): self
    {
        $this->affiliateId = $affiliateId;

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

    public function getMarketingId(): ?int
    {
        return $this->marketingId;
    }

    public function setMarketingId(int $marketingId): self
    {
        $this->marketingId = $marketingId;

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

    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function setCurrencyId(int $currencyId): self
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getCurrencyValue(): ?float
    {
        return $this->currencyValue;
    }

    public function setCurrencyValue(float $currencyValue): self
    {
        $this->currencyValue = $currencyValue;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getForwardedIp(): string
    {
        return $this->forwardedIp;
    }

    public function setForwardedIp($forwardedIp): self
    {
        $this->forwardedIp = $forwardedIp;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userA;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getAcceptLanguage(): ?string
    {
        return $this->acceptLanguage;
    }

    public function setAcceptLanguage(string $acceptLanguage): self
    {
        $this->acceptLanguage = $acceptLanguage;

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

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateModified(new \DateTime('now'));

        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
