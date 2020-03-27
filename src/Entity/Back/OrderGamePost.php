<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_orders_gamepost`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\OrderGamePostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrderGamePost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`type`", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", name="`product_name`")
     */
    private $productName;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="float", name="`price`")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", name="`amount`")
     */
    private $amount = 1;

    /**
     * @ORM\Column(type="string", name="`currency_name`", length=5)
     */
    private $currencyName;

    /**
     * @ORM\Column(type="string", name="`parent_name`", length=255)
     */
    private $parentName;

    /**
     * @ORM\Column(type="string", name="`phone`", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", name="`fio`", length=255)
     */
    private $fio;

    /**
     * @ORM\Column(type="string", name="`region`", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", name="`city`", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", name="`street`", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string", name="`house`", length=255)
     */
    private $house;

    /**
     * @ORM\Column(type="string", name="`warehouse`", length=255)
     */
    private $warehouse;

    /**
     * @ORM\Column(type="string", name="`mail`", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", name="`whant`")
     */
    private $whant;

    /**
     * @ORM\Column(type="string", name="`vip_num`", length=255)
     */
    private $vipNum;

    /**
     * @ORM\Column(type="integer", name="`time`")
     */
    private $time;

    /**
     * @ORM\Column(type="integer", name="`status`")
     */
    private $status;

    /**
     * @ORM\Column(type="string", name="`comments`")
     */
    private $comments;

    /**
     * @ORM\Column(type="integer", name="`archive`")
     */
    private $archive;

    /**
     * @ORM\Column(type="integer", name="`read`")
     */
    private $read;

    /**
     * @ORM\Column(type="boolean", name="`synchronize`")
     */
    private $synchronize;

    /**
     * @ORM\Column(type="integer", name="`client_id`")
     */
    private $clientId;

    /**
     * @ORM\Column(type="integer", name="`payment`")
     */
    private $payment;

    /**
     * @ORM\Column(type="integer", name="`delivery`")
     */
    private $delivery;

    /**
     * @ORM\Column(type="integer", name="`order_num`")
     */
    private $orderNum;

    /**
     * @ORM\Column(type="string", name="`track_number`", length=255)
     */
    private $trackNumber;

    /**
     * @ORM\Column(type="datetime", name="`track_number_date`")
     */
    private $trackNumberDate;

    /**
     * @ORM\Column(type="boolean", name="`money_given`")
     */
    private $moneyGiven;

    /**
     * @ORM\Column(type="boolean", name="`track_sent`")
     */
    private $trackSent;

    /**
     * @ORM\Column(type="string", name="`serial_num`", length=255)
     */
    private $serialNum;

    /**
     * @ORM\Column(type="integer", name="`shop_id`")
     */
    private $shopId;

    /**
     * @ORM\Column(type="integer", name="`shop_id_counterparty`")
     */
    private $shopIdCounterparty;

    /**
     * @ORM\Column(type="integer", name="`payment_wait_days`")
     */
    private $paymentWaitDays;

    /**
     * @ORM\Column(type="integer", name="`payment_wait_first_sum`")
     */
    private $paymentWaitFirstSum;

    /**
     * @ORM\Column(type="datetime", name="`payment_date`")
     */
    private $paymentDate;

    /**
     * @ORM\Column(type="integer", name="`document_id`")
     */
    private $documentId;

    /**
     * @ORM\Column(type="integer", name="`document_type`")
     */
    private $documentType = 2;

    /**
     * @ORM\Column(type="datetime", name="`invoice_sent`")
     */
    private $invoiceSent;

    /**
     * @ORM\Column(type="float", name="`currency_value`")
     */
    private $currencyValue;

    /**
     * @ORM\Column(type="string", name="`currency_value_when_purchasing`", length=255)
     */
    private $currencyValueWhenPurchasing;

    /**
     * @ORM\Column(type="float", name="`shipping_price`")
     */
    private $shippingPrice;

    /**
     * @ORM\Column(type="float", name="`shipping_price_old`")
     */
    private $shippingPriceOld;

    /**
     * @ORM\Column(type="string", name="`shipping_currency_name`", length=10)
     */
    private $shippingCurrencyName;

    /**
     * @ORM\Column(type="float", name="`shipping_currency_value`")
     */
    private $shippingCurrencyValue;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrencyName(): ?string
    {
        return $this->currencyName;
    }

    public function setCurrencyName(string $currencyName): self
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    public function setParentName(string $parentName): self
    {
        $this->parentName = $parentName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(string $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getWarehouse(): ?string
    {
        return $this->warehouse;
    }

    public function setWarehouse(string $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getWhant(): ?string
    {
        return $this->whant;
    }

    public function setWhant(string $whant): self
    {
        $this->whant = $whant;

        return $this;
    }

    public function getVipNum(): ?string
    {
        return $this->vipNum;
    }

    public function setVipNum(string $vipNum): self
    {
        $this->vipNum = $vipNum;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getArchive(): ?int
    {
        return $this->archive;
    }

    public function setArchive(int $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getRead(): ?int
    {
        return $this->read;
    }

    public function setRead(int $read): self
    {
        $this->read = $read;

        return $this;
    }

    public function getSynchronize(): ?bool
    {
        return $this->synchronize;
    }

    public function setSynchronize(bool $synchronize): self
    {
        $this->synchronize = $synchronize;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getPayment(): ?int
    {
        return $this->payment;
    }

    public function setPayment(int $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getDelivery(): ?int
    {
        return $this->delivery;
    }

    public function setDelivery(int $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getOrderNum(): ?int
    {
        return $this->orderNum;
    }

    public function setOrderNum(int $orderNum): self
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    public function getTrackNumber(): ?string
    {
        return $this->trackNumber;
    }

    public function setTrackNumber(string $trackNumber): self
    {
        $this->trackNumber = $trackNumber;

        return $this;
    }

    public function getTrackNumberDate(): ?\DateTimeInterface
    {
        return $this->trackNumberDate;
    }

    public function setTrackNumberDate(\DateTimeInterface $trackNumberDate): self
    {
        $this->trackNumberDate = $trackNumberDate;

        return $this;
    }

    public function getMoneyGiven(): ?bool
    {
        return $this->moneyGiven;
    }

    public function setMoneyGiven(bool $moneyGiven): self
    {
        $this->moneyGiven = $moneyGiven;

        return $this;
    }

    public function getTrackSent(): ?bool
    {
        return $this->trackSent;
    }

    public function setTrackSent(bool $trackSent): self
    {
        $this->trackSent = $trackSent;

        return $this;
    }

    public function getSerialNum(): ?string
    {
        return $this->serialNum;
    }

    public function setSerialNum(string $serialNum): self
    {
        $this->serialNum = $serialNum;

        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(int $shopId): self
    {
        $this->shopId = $shopId;

        return $this;
    }

    public function getShopIdCounterparty(): ?int
    {
        return $this->shopIdCounterparty;
    }

    public function setShopIdCounterparty(int $shopIdCounterparty): self
    {
        $this->shopIdCounterparty = $shopIdCounterparty;

        return $this;
    }

    public function getPaymentWaitDays(): ?int
    {
        return $this->paymentWaitDays;
    }

    public function setPaymentWaitDays(int $paymentWaitDays): self
    {
        $this->paymentWaitDays = $paymentWaitDays;

        return $this;
    }

    public function getPaymentWaitFirstSum(): ?int
    {
        return $this->paymentWaitFirstSum;
    }

    public function setPaymentWaitFirstSum(int $paymentWaitFirstSum): self
    {
        $this->paymentWaitFirstSum = $paymentWaitFirstSum;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getDocumentId(): ?int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId): self
    {
        $this->documentId = $documentId;

        return $this;
    }

    public function getDocumentType(): ?int
    {
        return $this->documentType;
    }

    public function setDocumentType(int $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function getInvoiceSent(): ?\DateTimeInterface
    {
        return $this->invoiceSent;
    }

    public function setInvoiceSent(\DateTimeInterface $invoiceSent): self
    {
        $this->invoiceSent = $invoiceSent;

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

    public function getCurrencyValueWhenPurchasing(): ?string
    {
        return $this->currencyValueWhenPurchasing;
    }

    public function setCurrencyValueWhenPurchasing(string $currencyValueWhenPurchasing): self
    {
        $this->currencyValueWhenPurchasing = $currencyValueWhenPurchasing;

        return $this;
    }

    public function getShippingPrice(): ?float
    {
        return $this->shippingPrice;
    }

    public function setShippingPrice(float $shippingPrice): self
    {
        $this->shippingPrice = $shippingPrice;

        return $this;
    }

    public function getShippingPriceOld(): ?float
    {
        return $this->shippingPriceOld;
    }

    public function setShippingPriceOld(float $shippingPriceOld): self
    {
        $this->shippingPriceOld = $shippingPriceOld;

        return $this;
    }

    public function getShippingCurrencyName(): ?string
    {
        return $this->shippingCurrencyName;
    }

    public function setShippingCurrencyName(string $shippingCurrencyName): self
    {
        $this->shippingCurrencyName = $shippingCurrencyName;

        return $this;
    }

    public function getShippingCurrencyValue(): ?float
    {
        return $this->shippingCurrencyValue;
    }

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
