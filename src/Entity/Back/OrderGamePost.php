<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_orders_gamepost`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderGamePostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderGamePost
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var string|null $type
     * @ORM\Column(type="string", name="`type`", length=255)
     */
    protected $type;

    /**
     * @var string|null $productName
     * @ORM\Column(type="string", name="`product_name`")
     */
    protected $productName;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price;

    /**
     * @var int|null $amount
     * @ORM\Column(type="integer", name="`amount`")
     */
    protected $amount = 1;

    /**
     * @var string|null $currencyName
     * @ORM\Column(type="string", name="`currency_name`", length=5)
     */
    protected $currencyName;

    /**
     * @var string|null $parentName
     * @ORM\Column(type="string", name="`parent_name`", length=255)
     */
    protected $parentName;

    /**
     * @var string|null $phone
     * @ORM\Column(type="string", name="`phone`", length=255)
     */
    protected $phone;

    /**
     * @var string|null $fio
     * @ORM\Column(type="string", name="`fio`", length=255)
     */
    protected $fio;

    /**
     * @var string|null $region
     * @ORM\Column(type="string", name="`region`", length=255)
     */
    protected $region;

    /**
     * @var string|null $city
     * @ORM\Column(type="string", name="`city`", length=255)
     */
    protected $city;

    /**
     * @var string|null $street
     * @ORM\Column(type="string", name="`street`", length=255)
     */
    protected $street;

    /**
     * @var string|null $house
     * @ORM\Column(type="string", name="`house`", length=255)
     */
    protected $house;

    /**
     * @var string|null $warehouse
     * @ORM\Column(type="string", name="`warehouse`", length=255)
     */
    protected $warehouse;

    /**
     * @var string|null $mail
     * @ORM\Column(type="string", name="`mail`", length=255)
     */
    protected $mail;

    /**
     * @var string|null $whant
     * @ORM\Column(type="string", name="`whant`")
     */
    protected $whant;

    /**
     * @var string|null $vipNum
     * @ORM\Column(type="string", name="`vip_num`", length=255)
     */
    protected $vipNum;

    /**
     * @var int|null $time
     * @ORM\Column(type="integer", name="`time`")
     */
    protected $time;

    /**
     * @var int|null $status
     * @ORM\Column(type="integer", name="`status`")
     */
    protected $status;

    /**
     * @var string|null $comments
     * @ORM\Column(type="string", name="`comments`")
     */
    protected $comments;

    /**
     * @var int|null $archive
     * @ORM\Column(type="integer", name="`archive`")
     */
    protected $archive;

    /**
     * @var int|null $read
     * @ORM\Column(type="integer", name="`read`")
     */
    protected $read;

    /**
     * @var bool|null $synchronize
     * @ORM\Column(type="boolean", name="`synchronize`")
     */
    protected $synchronize;

    /**
     * @var int|null $clientId
     * @ORM\Column(type="integer", name="`client_id`")
     */
    protected $clientId;

    /**
     * @var int|null $payment
     * @ORM\Column(type="integer", name="`payment`")
     */
    protected $payment;

    /**
     * @var int|null $delivery
     * @ORM\Column(type="integer", name="`delivery`")
     */
    protected $delivery;

    /**
     * @var int|null $orderNum
     * @ORM\Column(type="integer", name="`order_num`")
     */
    protected $orderNum;

    /**
     * @var string|null $trackNumber
     * @ORM\Column(type="string", name="`track_number`", length=255)
     */
    protected $trackNumber;

    /**
     * @var DateTimeInterface|null $trackNumberDate
     * @ORM\Column(type="datetime", name="`track_number_date`")
     */
    protected $trackNumberDate;

    /**
     * @var bool|null $moneyGiven
     * @ORM\Column(type="boolean", name="`money_given`")
     */
    protected $moneyGiven;

    /**
     * @var bool|null $trackSent
     * @ORM\Column(type="boolean", name="`track_sent`")
     */
    protected $trackSent;

    /**
     * @var string|null $serialNum
     * @ORM\Column(type="string", name="`serial_num`", length=255)
     */
    protected $serialNum;

    /**
     * @var int|null $shopId
     * @ORM\Column(type="integer", name="`shop_id`")
     */
    protected $shopId;

    /**
     * @var int|null $shopIdCounterparty
     * @ORM\Column(type="integer", name="`shop_id_counterparty`")
     */
    protected $shopIdCounterparty;

    /**
     * @var int|null $paymentWaitDays
     * @ORM\Column(type="integer", name="`payment_wait_days`")
     */
    protected $paymentWaitDays;

    /**
     * @var int|null $paymentWaitFirstSum
     * @ORM\Column(type="integer", name="`payment_wait_first_sum`")
     */
    protected $paymentWaitFirstSum;

    /**
     * @var DateTimeInterface|null $paymentDate
     * @ORM\Column(type="datetime", name="`payment_date`")
     */
    protected $paymentDate;

    /**
     * @var int|null $documentId
     * @ORM\Column(type="integer", name="`document_id`")
     */
    protected $documentId;

    /**
     * @var int|null $documentType
     * @ORM\Column(type="integer", name="`document_type`")
     */
    protected $documentType = 2;

    /**
     * @var DateTimeInterface|null $invoiceSent
     * @ORM\Column(type="datetime", name="`invoice_sent`")
     */
    protected $invoiceSent;

    /**
     * @var float|null $currencyValue
     * @ORM\Column(type="float", name="`currency_value`")
     */
    protected $currencyValue;

    /**
     * @var string|null $currencyValueWhenPurchasing
     * @ORM\Column(type="string", name="`currency_value_when_purchasing`", length=255)
     */
    protected $currencyValueWhenPurchasing;

    /**
     * @var float|null $shippingPrice
     * @ORM\Column(type="float", name="`shipping_price`")
     */
    protected $shippingPrice;

    /**
     * @var float|null $shippingPriceOld
     * @ORM\Column(type="float", name="`shipping_price_old`")
     */
    protected $shippingPriceOld;

    /**
     * @var string|null $shippingCurrencyName
     * @ORM\Column(type="string", name="`shipping_currency_name`", length=10)
     */
    protected $shippingCurrencyName;

    /**
     * @var float|null $shippingCurrencyValue
     * @ORM\Column(type="float", name="`shipping_currency_value`")
     */
    protected $shippingCurrencyValue;

    /**
     * @param string $type
     * @param string $productName
     * @param int $productId
     * @param float $price
     * @param int $amount
     * @param string $currencyName
     * @param string $parentName
     * @param string $phone
     * @param string $fio
     * @param string $region
     * @param string $city
     * @param string $street
     * @param string $house
     * @param string $warehouse
     * @param string $mail
     * @param string $whant
     * @param string $vipNum
     * @param int $time
     * @param int $status
     * @param string $comments
     * @param int $archive
     * @param int $read
     * @param bool $synchronize
     * @param int $clientId
     * @param int $payment
     * @param int $delivery
     * @param int $orderNum
     * @param string $trackNumber
     * @param \DateTimeInterface $trackNumberDate
     * @param bool $moneyGiven
     * @param bool $trackSent
     * @param string $serialNum
     * @param int $shopId
     * @param int $shopIdCounterparty
     * @param int $paymentWaitDays
     * @param int $paymentWaitFirstSum
     * @param \DateTimeInterface $paymentDate
     * @param int $documentId
     * @param int $documentType
     * @param \DateTimeInterface $invoiceSent
     * @param float $currencyValue
     * @param string $currencyValueWhenPurchasing
     * @param float $shippingPrice
     * @param float $shippingPriceOld
     * @param string $shippingCurrencyName
     * @param float $shippingCurrencyValue
     */
    public function fill(
        string $type,
        string $productName,
        int $productId,
        float $price,
        int $amount,
        string $currencyName,
        string $parentName,
        string $phone,
        string $fio,
        string $region,
        string $city,
        string $street,
        string $house,
        string $warehouse,
        string $mail,
        string $whant,
        string $vipNum,
        int $time,
        int $status,
        string $comments,
        int $archive,
        int $read,
        bool $synchronize,
        int $clientId,
        int $payment,
        int $delivery,
        int $orderNum,
        string $trackNumber,
        \DateTimeInterface $trackNumberDate,
        bool $moneyGiven,
        bool $trackSent,
        string $serialNum,
        int $shopId,
        int $shopIdCounterparty,
        int $paymentWaitDays,
        int $paymentWaitFirstSum,
        \DateTimeInterface $paymentDate,
        int $documentId,
        int $documentType,
        \DateTimeInterface $invoiceSent,
        float $currencyValue,
        string $currencyValueWhenPurchasing,
        float $shippingPrice,
        float $shippingPriceOld,
        string $shippingCurrencyName,
        float $shippingCurrencyValue
    )
    {
        $this->type = $type;
        $this->productName = $productName;
        $this->productId = $productId;
        $this->price = $price;
        $this->amount = $amount;
        $this->currencyName = $currencyName;
        $this->parentName = $parentName;
        $this->phone = $phone;
        $this->fio = $fio;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
        $this->warehouse = $warehouse;
        $this->mail = $mail;
        $this->whant = $whant;
        $this->vipNum = $vipNum;
        $this->time = $time;
        $this->status = $status;
        $this->comments = $comments;
        $this->archive = $archive;
        $this->read = $read;
        $this->synchronize = $synchronize;
        $this->clientId = $clientId;
        $this->payment = $payment;
        $this->delivery = $delivery;
        $this->orderNum = $orderNum;
        $this->trackNumber = $trackNumber;
        $this->trackNumberDate = $trackNumberDate;
        $this->moneyGiven = $moneyGiven;
        $this->trackSent = $trackSent;
        $this->serialNum = $serialNum;
        $this->shopId = $shopId;
        $this->shopIdCounterparty = $shopIdCounterparty;
        $this->paymentWaitDays = $paymentWaitDays;
        $this->paymentWaitFirstSum = $paymentWaitFirstSum;
        $this->paymentDate = $paymentDate;
        $this->documentId = $documentId;
        $this->documentType = $documentType;
        $this->invoiceSent = $invoiceSent;
        $this->currencyValue = $currencyValue;
        $this->currencyValueWhenPurchasing = $currencyValueWhenPurchasing;
        $this->shippingPrice = $shippingPrice;
        $this->shippingPriceOld = $shippingPriceOld;
        $this->shippingCurrencyName = $shippingCurrencyName;
        $this->shippingCurrencyValue = $shippingCurrencyValue;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return OrderGamePost
     */
    public function setType(string $type): self
    {
        $this->type = $type;

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
     * @return OrderGamePost
     */
    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

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
     * @return OrderGamePost
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return OrderGamePost
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return OrderGamePost
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencyName(): ?string
    {
        return $this->currencyName;
    }

    /**
     * @param string $currencyName
     * @return OrderGamePost
     */
    public function setCurrencyName(string $currencyName): self
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    /**
     * @param string $parentName
     * @return OrderGamePost
     */
    public function setParentName(string $parentName): self
    {
        $this->parentName = $parentName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return OrderGamePost
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFio(): ?string
    {
        return $this->fio;
    }

    /**
     * @param string $fio
     * @return OrderGamePost
     */
    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return OrderGamePost
     */
    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return OrderGamePost
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return OrderGamePost
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }

    /**
     * @param string $house
     * @return OrderGamePost
     */
    public function setHouse(string $house): self
    {
        $this->house = $house;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWarehouse(): ?string
    {
        return $this->warehouse;
    }

    /**
     * @param string $warehouse
     * @return OrderGamePost
     */
    public function setWarehouse(string $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return OrderGamePost
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWhant(): ?string
    {
        return $this->whant;
    }

    /**
     * @param string $whant
     * @return OrderGamePost
     */
    public function setWhant(string $whant): self
    {
        $this->whant = $whant;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVipNum(): ?string
    {
        return $this->vipNum;
    }

    /**
     * @param string $vipNum
     * @return OrderGamePost
     */
    public function setVipNum(string $vipNum): self
    {
        $this->vipNum = $vipNum;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTime(): ?int
    {
        return $this->time;
    }

    /**
     * @param int $time
     * @return OrderGamePost
     */
    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return OrderGamePost
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     * @return OrderGamePost
     */
    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getArchive(): ?int
    {
        return $this->archive;
    }

    /**
     * @param int $archive
     * @return OrderGamePost
     */
    public function setArchive(int $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRead(): ?int
    {
        return $this->read;
    }

    /**
     * @param int $read
     * @return OrderGamePost
     */
    public function setRead(int $read): self
    {
        $this->read = $read;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSynchronize(): ?bool
    {
        return $this->synchronize;
    }

    /**
     * @param bool $synchronize
     * @return OrderGamePost
     */
    public function setSynchronize(bool $synchronize): self
    {
        $this->synchronize = $synchronize;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     * @return OrderGamePost
     */
    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPayment(): ?int
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     * @return OrderGamePost
     */
    public function setPayment(int $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDelivery(): ?int
    {
        return $this->delivery;
    }

    /**
     * @param int $delivery
     * @return OrderGamePost
     */
    public function setDelivery(int $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderNum(): ?int
    {
        return $this->orderNum;
    }

    /**
     * @param int $orderNum
     * @return OrderGamePost
     */
    public function setOrderNum(int $orderNum): self
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackNumber(): ?string
    {
        return $this->trackNumber;
    }

    /**
     * @param string $trackNumber
     * @return OrderGamePost
     */
    public function setTrackNumber(string $trackNumber): self
    {
        $this->trackNumber = $trackNumber;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getTrackNumberDate(): ?DateTimeInterface
    {
        return $this->trackNumberDate;
    }

    /**
     * @param DateTimeInterface $trackNumberDate
     * @return OrderGamePost
     */
    public function setTrackNumberDate(DateTimeInterface $trackNumberDate): self
    {
        $this->trackNumberDate = $trackNumberDate;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMoneyGiven(): ?bool
    {
        return $this->moneyGiven;
    }

    /**
     * @param bool $moneyGiven
     * @return OrderGamePost
     */
    public function setMoneyGiven(bool $moneyGiven): self
    {
        $this->moneyGiven = $moneyGiven;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTrackSent(): ?bool
    {
        return $this->trackSent;
    }

    /**
     * @param bool $trackSent
     * @return OrderGamePost
     */
    public function setTrackSent(bool $trackSent): self
    {
        $this->trackSent = $trackSent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSerialNum(): ?string
    {
        return $this->serialNum;
    }

    /**
     * @param string $serialNum
     * @return OrderGamePost
     */
    public function setSerialNum(string $serialNum): self
    {
        $this->serialNum = $serialNum;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     * @return OrderGamePost
     */
    public function setShopId(int $shopId): self
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShopIdCounterparty(): ?int
    {
        return $this->shopIdCounterparty;
    }

    /**
     * @param int $shopIdCounterparty
     * @return OrderGamePost
     */
    public function setShopIdCounterparty(int $shopIdCounterparty): self
    {
        $this->shopIdCounterparty = $shopIdCounterparty;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPaymentWaitDays(): ?int
    {
        return $this->paymentWaitDays;
    }

    /**
     * @param int $paymentWaitDays
     * @return OrderGamePost
     */
    public function setPaymentWaitDays(int $paymentWaitDays): self
    {
        $this->paymentWaitDays = $paymentWaitDays;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPaymentWaitFirstSum(): ?int
    {
        return $this->paymentWaitFirstSum;
    }

    /**
     * @param int $paymentWaitFirstSum
     * @return OrderGamePost
     */
    public function setPaymentWaitFirstSum(int $paymentWaitFirstSum): self
    {
        $this->paymentWaitFirstSum = $paymentWaitFirstSum;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    /**
     * @param DateTimeInterface $paymentDate
     * @return OrderGamePost
     */
    public function setPaymentDate(DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDocumentId(): ?int
    {
        return $this->documentId;
    }

    /**
     * @param int $documentId
     * @return OrderGamePost
     */
    public function setDocumentId(int $documentId): self
    {
        $this->documentId = $documentId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDocumentType(): ?int
    {
        return $this->documentType;
    }

    /**
     * @param int $documentType
     * @return OrderGamePost
     */
    public function setDocumentType(int $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getInvoiceSent(): ?DateTimeInterface
    {
        return $this->invoiceSent;
    }

    /**
     * @param DateTimeInterface $invoiceSent
     * @return OrderGamePost
     */
    public function setInvoiceSent(DateTimeInterface $invoiceSent): self
    {
        $this->invoiceSent = $invoiceSent;

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
     * @return OrderGamePost
     */
    public function setCurrencyValue(float $currencyValue): self
    {
        $this->currencyValue = $currencyValue;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencyValueWhenPurchasing(): ?string
    {
        return $this->currencyValueWhenPurchasing;
    }

    /**
     * @param string $currencyValueWhenPurchasing
     * @return OrderGamePost
     */
    public function setCurrencyValueWhenPurchasing(string $currencyValueWhenPurchasing): self
    {
        $this->currencyValueWhenPurchasing = $currencyValueWhenPurchasing;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getShippingPrice(): ?float
    {
        return $this->shippingPrice;
    }

    /**
     * @param float $shippingPrice
     * @return OrderGamePost
     */
    public function setShippingPrice(float $shippingPrice): self
    {
        $this->shippingPrice = $shippingPrice;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getShippingPriceOld(): ?float
    {
        return $this->shippingPriceOld;
    }

    /**
     * @param float $shippingPriceOld
     * @return OrderGamePost
     */
    public function setShippingPriceOld(float $shippingPriceOld): self
    {
        $this->shippingPriceOld = $shippingPriceOld;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingCurrencyName(): ?string
    {
        return $this->shippingCurrencyName;
    }

    /**
     * @param string $shippingCurrencyName
     * @return OrderGamePost
     */
    public function setShippingCurrencyName(string $shippingCurrencyName): self
    {
        $this->shippingCurrencyName = $shippingCurrencyName;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getShippingCurrencyValue(): ?float
    {
        return $this->shippingCurrencyValue;
    }

    /**
     * @param float $shippingCurrencyValue
     * @return OrderGamePost
     */
    public function setShippingCurrencyValue(float $shippingCurrencyValue): self
    {
        $this->shippingCurrencyValue = $shippingCurrencyValue;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        $this->setTime(time());
    }
}
