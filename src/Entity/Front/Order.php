<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderRepository")
 */
class Order
{
    /**
     * @var int|null $orderId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var int|null $invoiceNo
     * @ORM\Column(type="integer", name="`invoice_no`")
     */
    protected $invoiceNo = 0;

    /**
     * @var string|null $invoicePrefix
     * @ORM\Column(type="string", name="`invoice_prefix`", length=26)
     */
    protected $invoicePrefix;

    /**
     * @var int|null $storeId
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId = 0;

    /**
     * @var string|null $storeName
     * @ORM\Column(type="string", name="`store_name`", length=64)
     */
    protected $storeName;

    /**
     * @var string|null $storeUrl
     * @ORM\Column(type="string", name="`store_url`", length=255)
     */
    protected $storeUrl;

    /**
     * @var int|null $customerId
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId = 0;

    /**
     * @var int|null $customerGroupId
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId = 0;

    /**
     * @var string|null $firstName
     * @ORM\Column(type="string", name="`firstname`", length=32)
     */
    protected $firstName;

    /**
     * @var string|null $lastName
     * @ORM\Column(type="string", name="`lastname`", length=32)
     */
    protected $lastName;

    /**
     * @var string|null $email
     * @ORM\Column(type="string", name="`email`", length=96)
     */
    protected $email;

    /**
     * @var string|null $telephone
     * @ORM\Column(type="string", name="`telephone`", length=32)
     */
    protected $telephone;

    /**
     * @var string|null $fax
     * @ORM\Column(type="string", name="`fax`", length=32)
     */
    protected $fax;

    /**
     * @var string|null $customField
     * @ORM\Column(type="string", name="`custom_field`", length=255)
     */
    protected $customField;

    /**
     * @var string|null $paymentFirstName
     * @ORM\Column(type="string", name="`payment_firstname`", length=32)
     */
    protected $paymentFirstName;

    /**
     * @var string|null $paymentLastName
     * @ORM\Column(type="string", name="`payment_lastname`", length=32)
     */
    protected $paymentLastName;

    /**
     * @var string|null $paymentCompany
     * @ORM\Column(type="string", name="`payment_company`", length=60)
     */
    protected $paymentCompany;

    /**
     * @var string|null $paymentAddress1
     * @ORM\Column(type="string", name="`payment_address_1`", length=128)
     */
    protected $paymentAddress1;

    /**
     * @var string|null $paymentAddress2
     * @ORM\Column(type="string", name="`payment_address_2`", length=128)
     */
    protected $paymentAddress2;

    /**
     * @var string|null $paymentCity
     * @ORM\Column(type="string", name="`payment_city`", length=128)
     */
    protected $paymentCity;

    /**
     * @var string|null $paymentPostCode
     * @ORM\Column(type="string", name="`payment_postcode`", length=10)
     */
    protected $paymentPostCode;

    /**
     * @var string|null $paymentCountry
     * @ORM\Column(type="string", name="`payment_country`", length=128)
     */
    protected $paymentCountry;

    /**
     * @var int|null $paymentCountryId
     * @ORM\Column(type="integer", name="`payment_country_id`")
     */
    protected $paymentCountryId;

    /**
     * @var string|null $paymentZone
     * @ORM\Column(type="string", name="`payment_zone`", length=128)
     */
    protected $paymentZone;

    /**
     * @var int|null $paymentZoneId
     * @ORM\Column(type="integer", name="`payment_zone_id`")
     */
    protected $paymentZoneId;

    /**
     * @var string|null $paymentAddressFormat
     * @ORM\Column(type="string", name="`payment_address_format`", length=255)
     */
    protected $paymentAddressFormat;

    /**
     * @var string|null $paymentCustomField
     * @ORM\Column(type="string", name="`payment_custom_field`", length=255)
     */
    protected $paymentCustomField;

    /**
     * @var string|null $paymentMethod
     * @ORM\Column(type="string", name="`payment_method`", length=128)
     */
    protected $paymentMethod;

    /**
     * @var string|null $paymentCode
     * @ORM\Column(type="string", name="`payment_code`", length=128)
     */
    protected $paymentCode;

    /**
     * @var string|null $shippingFirstName
     * @ORM\Column(type="string", name="`shipping_firstname`", length=32)
     */
    protected $shippingFirstName;

    /**
     * @var string|null $shippingLastName
     * @ORM\Column(type="string", name="`shipping_lastname`", length=32)
     */
    protected $shippingLastName;

    /**
     * @var string|null $shippingCompany
     * @ORM\Column(type="string", name="`shipping_company`", length=40)
     */
    protected $shippingCompany;

    /**
     * @var string|null $shippingAddress1
     * @ORM\Column(type="string", name="`shipping_address_1`", length=128)
     */
    protected $shippingAddress1;

    /**
     * @var string|null $shippingAddress2
     * @ORM\Column(type="string", name="`shipping_address_2`", length=128)
     */
    protected $shippingAddress2;

    /**
     * @var string|null $shippingCity
     * @ORM\Column(type="string", name="`shipping_city`", length=128)
     */
    protected $shippingCity;

    /**
     * @var string|null $shippingPostCode
     * @ORM\Column(type="string", name="`shipping_postcode`", length=10)
     */
    protected $shippingPostCode;

    /**
     * @var string|null $shippingCountry
     * @ORM\Column(type="string", name="`shipping_country`", length=128)
     */
    protected $shippingCountry;

    /**
     * @var int|null $shippingCountryId
     * @ORM\Column(type="integer", name="`shipping_country_id`")
     */
    protected $shippingCountryId;

    /**
     * @var string|null $shippingZone
     * @ORM\Column(type="string", name="`shipping_zone`", length=128)
     */
    protected $shippingZone;

    /**
     * @var int|null $shippingZoneId
     * @ORM\Column(type="integer", name="`shipping_zone_id`")
     */
    protected $shippingZoneId;

    /**
     * @var string|null $shippingAddressFormat
     * @ORM\Column(type="string", name="`shipping_address_format`", length=255)
     */
    protected $shippingAddressFormat;

    /**
     * @var string|null $shippingCustomField
     * @ORM\Column(type="string", name="`shipping_custom_field`", length=255)
     */
    protected $shippingCustomField;

    /**
     * @var string|null $shippingMethod
     * @ORM\Column(type="string", name="`shipping_method`", length=128)
     */
    protected $shippingMethod;

    /**
     * @var string|null $shippingCode
     * @ORM\Column(type="string", name="`shipping_code`", length=128)
     */
    protected $shippingCode;

    /**
     * @var string|null $comment
     * @ORM\Column(type="string", name="`comment`", length=255)
     */
    protected $comment;

    /**
     * @var float|null $total
     * @ORM\Column(type="float", name="`total`")
     */
    protected $total = 0.0;

    /**
     * @var int|null $orderStatusId
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    protected $orderStatusId = 0;

    /**
     * @var int|null $affiliateId
     * @ORM\Column(type="integer", name="`affiliate_id`")
     */
    protected $affiliateId;

    /**
     * @var float|null $commission
     * @ORM\Column(type="float", name="`commission`")
     */
    protected $commission;

    /**
     * @var int|null $marketingId
     * @ORM\Column(type="integer", name="`marketing_id`")
     */
    protected $marketingId;

    /**
     * @var string|null $tracking
     * @ORM\Column(type="string", name="`tracking`", length=64)
     */
    protected $tracking;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var int|null $currencyId
     * @ORM\Column(type="integer", name="`currency_id`")
     */
    protected $currencyId;

    /**
     * @var string|null $currencyCode
     * @ORM\Column(type="string", name="`currency_code`", length=3)
     */
    protected $currencyCode;

    /**
     * @var int|null $currencyValue
     * @ORM\Column(type="float", name="`currency_value`")
     */
    protected $currencyValue = 1.0;

    /**
     * @var string|null $ip
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @var string|null $forwardedIp
     * @ORM\Column(type="string", name="`forwarded_ip`", length=255)
     */
    protected $forwardedIp;

    /**
     * @var string|null $userAgent
     * @ORM\Column(type="string", name="`user_agent`", length=255)
     */
    protected $userAgent;

    /**
     * @var string|null $acceptLanguage
     * @ORM\Column(type="string", name="`accept_language`", length=255)
     */
    protected $acceptLanguage;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @var DateTimeInterface|null $dateModified
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    protected $dateModified;

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @return int|null
     */
    public function getInvoiceNo(): ?int
    {
        return $this->invoiceNo;
    }

    /**
     * @param int $invoiceNo
     * @return Order
     */
    public function setInvoiceNo(int $invoiceNo): self
    {
        $this->invoiceNo = $invoiceNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInvoicePrefix(): ?string
    {
        return $this->invoicePrefix;
    }

    /**
     * @param string $invoicePrefix
     * @return Order
     */
    public function setInvoicePrefix(string $invoicePrefix): self
    {
        $this->invoicePrefix = $invoicePrefix;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     * @return Order
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    /**
     * @param string $storeName
     * @return Order
     */
    public function setStoreName(string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStoreUrl(): ?string
    {
        return $this->storeUrl;
    }

    /**
     * @param string $storeUrl
     * @return Order
     */
    public function setStoreUrl(string $storeUrl): self
    {
        $this->storeUrl = $storeUrl;

        return $this;
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
     * @return Order
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    /**
     * @param int $customerGroupId
     * @return Order
     */
    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Order
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Order
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Order
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return Order
     */
    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     * @return Order
     */
    public function setFax(string $fax): self
    {
        $this->fax = $fax;

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
     * @return Order
     */
    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentFirstName(): ?string
    {
        return $this->paymentFirstName;
    }

    /**
     * @param string $paymentFirstName
     * @return Order
     */
    public function setPaymentFirstName(string $paymentFirstName): self
    {
        $this->paymentFirstName = $paymentFirstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentLastName(): ?string
    {
        return $this->paymentLastName;
    }

    /**
     * @param string $paymentLastName
     * @return Order
     */
    public function setPaymentLastName(string $paymentLastName): self
    {
        $this->paymentLastName = $paymentLastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentCompany(): ?string
    {
        return $this->paymentCompany;
    }

    /**
     * @param string $paymentCompany
     * @return Order
     */
    public function setPaymentCompany(string $paymentCompany): self
    {
        $this->paymentCompany = $paymentCompany;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentAddress1(): ?string
    {
        return $this->paymentAddress1;
    }

    /**
     * @param string $paymentAddress1
     * @return Order
     */
    public function setPaymentAddress1(string $paymentAddress1): self
    {
        $this->paymentAddress1 = $paymentAddress1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentAddress2(): ?string
    {
        return $this->paymentAddress2;
    }

    /**
     * @param string $paymentAddress2
     * @return Order
     */
    public function setPaymentAddress2(string $paymentAddress2): self
    {
        $this->paymentAddress2 = $paymentAddress2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentCity(): ?string
    {
        return $this->paymentCity;
    }

    /**
     * @param string $paymentCity
     * @return Order
     */
    public function setPaymentCity(string $paymentCity): self
    {
        $this->paymentCity = $paymentCity;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentPostCode(): ?string
    {
        return $this->paymentPostCode;
    }

    /**
     * @param string $paymentPostCode
     * @return Order
     */
    public function setPaymentPostCode(string $paymentPostCode): self
    {
        $this->paymentPostCode = $paymentPostCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentCountry(): ?string
    {
        return $this->paymentCountry;
    }

    /**
     * @param string $paymentCountry
     * @return Order
     */
    public function setPaymentCountry(string $paymentCountry): self
    {
        $this->paymentCountry = $paymentCountry;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPaymentCountryId(): ?int
    {
        return $this->paymentCountryId;
    }

    /**
     * @param int $paymentCountryId
     * @return Order
     */
    public function setPaymentCountryId(int $paymentCountryId): self
    {
        $this->paymentCountryId = $paymentCountryId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentZone(): ?string
    {
        return $this->paymentZone;
    }

    /**
     * @param string $paymentZone
     * @return Order
     */
    public function setPaymentZone(string $paymentZone): self
    {
        $this->paymentZone = $paymentZone;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPaymentZoneId(): ?int
    {
        return $this->paymentZoneId;
    }

    /**
     * @param int $paymentZoneId
     * @return Order
     */
    public function setPaymentZoneId(int $paymentZoneId): self
    {
        $this->paymentZoneId = $paymentZoneId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentAddressFormat(): ?string
    {
        return $this->paymentAddressFormat;
    }

    /**
     * @param string $paymentAddressFormat
     * @return Order
     */
    public function setPaymentAddressFormat(string $paymentAddressFormat): self
    {
        $this->paymentAddressFormat = $paymentAddressFormat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentCustomField(): ?string
    {
        return $this->paymentCustomField;
    }

    /**
     * @param string $paymentCustomField
     * @return Order
     */
    public function setPaymentCustomField(string $paymentCustomField): self
    {
        $this->paymentCustomField = $paymentCustomField;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return Order
     */
    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentCode(): ?string
    {
        return $this->paymentCode;
    }

    /**
     * @param string $paymentCode
     * @return Order
     */
    public function setPaymentCode(string $paymentCode): self
    {
        $this->paymentCode = $paymentCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingFirstName(): ?string
    {
        return $this->shippingFirstName;
    }

    /**
     * @param string $shippingFirstName
     * @return Order
     */
    public function setShippingFirstName(string $shippingFirstName): self
    {
        $this->shippingFirstName = $shippingFirstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingLastName(): ?string
    {
        return $this->shippingLastName;
    }

    /**
     * @param string $shippingLastName
     * @return Order
     */
    public function setShippingLastName(string $shippingLastName): self
    {
        $this->shippingLastName = $shippingLastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCompany(): ?string
    {
        return $this->shippingCompany;
    }

    /**
     * @param string $shippingCompany
     * @return Order
     */
    public function setShippingCompany(string $shippingCompany): self
    {
        $this->shippingCompany = $shippingCompany;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingAddress1(): ?string
    {
        return $this->shippingAddress1;
    }

    /**
     * @param string $shippingAddress1
     * @return Order
     */
    public function setShippingAddress1(string $shippingAddress1): self
    {
        $this->shippingAddress1 = $shippingAddress1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingAddress2(): ?string
    {
        return $this->shippingAddress2;
    }

    /**
     * @param string $shippingAddress2
     * @return Order
     */
    public function setShippingAddress2(string $shippingAddress2): self
    {
        $this->shippingAddress2 = $shippingAddress2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCity(): ?string
    {
        return $this->shippingCity;
    }

    /**
     * @param string $shippingCity
     * @return Order
     */
    public function setShippingCity(string $shippingCity): self
    {
        $this->shippingCity = $shippingCity;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingPostCode(): ?string
    {
        return $this->shippingPostCode;
    }

    /**
     * @param string $shippingPostCode
     * @return Order
     */
    public function setShippingPostCode(string $shippingPostCode): self
    {
        $this->shippingPostCode = $shippingPostCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCountry(): ?string
    {
        return $this->shippingCountry;
    }

    /**
     * @param string $shippingCountry
     * @return Order
     */
    public function setShippingCountry(string $shippingCountry): self
    {
        $this->shippingCountry = $shippingCountry;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShippingCountryId(): ?int
    {
        return $this->shippingCountryId;
    }

    /**
     * @param int $shippingCountryId
     * @return Order
     */
    public function setShippingCountryId(int $shippingCountryId): self
    {
        $this->shippingCountryId = $shippingCountryId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingZone(): ?string
    {
        return $this->shippingZone;
    }

    /**
     * @param string $shippingZone
     * @return Order
     */
    public function setShippingZone(string $shippingZone): self
    {
        $this->shippingZone = $shippingZone;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShippingZoneId(): ?int
    {
        return $this->shippingZoneId;
    }

    /**
     * @param int $shippingZoneId
     * @return Order
     */
    public function setShippingZoneId(int $shippingZoneId): self
    {
        $this->shippingZoneId = $shippingZoneId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingAddressFormat(): ?string
    {
        return $this->shippingAddressFormat;
    }

    /**
     * @param string $shippingAddressFormat
     * @return Order
     */
    public function setShippingAddressFormat(string $shippingAddressFormat): self
    {
        $this->shippingAddressFormat = $shippingAddressFormat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCustomField(): ?string
    {
        return $this->shippingCustomField;
    }

    /**
     * @param string $shippingCustomField
     * @return Order
     */
    public function setShippingCustomField(string $shippingCustomField): self
    {
        $this->shippingCustomField = $shippingCustomField;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    /**
     * @param string $shippingMethod
     * @return Order
     */
    public function setShippingMethod(string $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCode(): ?string
    {
        return $this->shippingCode;
    }

    /**
     * @param string $shippingCode
     * @return Order
     */
    public function setShippingCode(string $shippingCode): self
    {
        $this->shippingCode = $shippingCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Order
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float $total
     * @return Order
     */
    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderStatusId(): ?int
    {
        return $this->orderStatusId;
    }

    /**
     * @param int $orderStatusId
     * @return Order
     */
    public function setOrderStatusId(int $orderStatusId): self
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAffiliateId(): ?int
    {
        return $this->affiliateId;
    }

    /**
     * @param int $affiliateId
     * @return Order
     */
    public function setAffiliateId(int $affiliateId): self
    {
        $this->affiliateId = $affiliateId;

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
     * @return Order
     */
    public function setCommission(float $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMarketingId(): ?int
    {
        return $this->marketingId;
    }

    /**
     * @param int $marketingId
     * @return Order
     */
    public function setMarketingId(int $marketingId): self
    {
        $this->marketingId = $marketingId;

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
     * @return Order
     */
    public function setTracking(string $tracking): self
    {
        $this->tracking = $tracking;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     * @return Order
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    /**
     * @param int $currencyId
     * @return Order
     */
    public function setCurrencyId(int $currencyId): self
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return Order
     */
    public function setCurrencyCode(string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getCurrencyValue(): ?float
    {
        return $this->currencyValue;
    }

    /**
     * @param float $currencyValue
     * @return Order
     */
    public function setCurrencyValue(float $currencyValue): self
    {
        $this->currencyValue = $currencyValue;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return Order
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getForwardedIp(): ?string
    {
        return $this->forwardedIp;
    }

    /**
     * @param $forwardedIp
     * @return Order
     */
    public function setForwardedIp($forwardedIp): self
    {
        $this->forwardedIp = $forwardedIp;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     * @return Order
     */
    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAcceptLanguage(): ?string
    {
        return $this->acceptLanguage;
    }

    /**
     * @param string $acceptLanguage
     * @return Order
     */
    public function setAcceptLanguage(string $acceptLanguage): self
    {
        $this->acceptLanguage = $acceptLanguage;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateModified(): ?DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param DateTimeInterface $dateModified
     * @return Order
     */
    public function setDateModified(DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

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
     * @return Order
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
