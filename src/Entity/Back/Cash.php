<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_cash`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\CashRepository")
 */
class Cash
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var int|null $orderNum
     * @ORM\Column(type="integer", name="`order_num`")
     */
    protected $orderNum;

    /**
     * @var DateTimeInterface|null $date
     * @ORM\Column(type="date", name="`date`")
     */
    protected $date;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price;

    /**
     * @var string|null $currencyName
     * @ORM\Column(type="string", name="`currency_name`", length=255)
     */
    protected $currencyName;

    /**
     * @var float|null $currencyValue
     * @ORM\Column(type="float", name="`currency_value`")
     */
    protected $currencyValue;

    /**
     * @var bool|null $synchronize
     * @ORM\Column(type="boolean", name="`synchronize`")
     */
    protected $synchronize;

    /**
     * @var string|null $message
     * @ORM\Column(type="string", name="`message`", length=255)
     */
    protected $message;

    /**
     * @var string|null $fio
     * @ORM\Column(type="string", name="`fio`", length=255)
     */
    protected $fio;

    /**
     * @var int|null $documentId
     * @ORM\Column(type="integer", name="`document_id`")
     */
    protected $documentId;

    /**
     * @var int|null $shopId
     * @ORM\Column(type="integer", name="`shop_id`")
     */
    protected $shopId;

    /**
     * @var int|null $cashTypeId
     * @ORM\Column(type="integer", name="`cash_type_id`")
     */
    protected $cashTypeId;

    /**
     * @var string|null $cardNum
     * @ORM\Column(type="string", name="`card_num`")
     */
    protected $cardNum;

    /**
     * @var bool|null $cashOut
     * @ORM\Column(type="boolean", name="`cash_out`")
     */
    protected $cashOut;

    /**
     * @var int|null $shippingOrderId
     * @ORM\Column(type="integer", name="`shipping_order_id`")
     */
    protected $shippingOrderId;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Cash
     */
    public function setOrderNum(int $orderNum): self
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     * @return Cash
     */
    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

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
     * @return Cash
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

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
     * @return Cash
     */
    public function setCurrencyName(string $currencyName): self
    {
        $this->currencyName = $currencyName;

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
     * @return Cash
     */
    public function setCurrencyValue(float $currencyValue): self
    {
        $this->currencyValue = $currencyValue;

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
     * @return Cash
     */
    public function setSynchronize(bool $synchronize): self
    {
        $this->synchronize = $synchronize;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Cash
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

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
     * @return Cash
     */
    public function setFio(string $fio): self
    {
        $this->fio = $fio;

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
     * @return Cash
     */
    public function setDocumentId(int $documentId): self
    {
        $this->documentId = $documentId;

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
     * @return Cash
     */
    public function setShopId(int $shopId): self
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCashTypeId(): ?int
    {
        return $this->cashTypeId;
    }

    /**
     * @param int $cashTypeId
     * @return Cash
     */
    public function setCashTypeId(int $cashTypeId): self
    {
        $this->cashTypeId = $cashTypeId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNum(): ?string
    {
        return $this->cardNum;
    }

    /**
     * @param string $cardNum
     * @return Cash
     */
    public function setCardNum(string $cardNum): self
    {
        $this->cardNum = $cardNum;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCashOut(): ?bool
    {
        return $this->cashOut;
    }

    /**
     * @param bool $cashOut
     * @return Cash
     */
    public function setCashOut(bool $cashOut): self
    {
        $this->cashOut = $cashOut;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShippingOrderId(): ?int
    {
        return $this->shippingOrderId;
    }

    /**
     * @param int $shippingOrderId
     * @return Cash
     */
    public function setShippingOrderId(int $shippingOrderId): self
    {
        $this->shippingOrderId = $shippingOrderId;

        return $this;
    }
}
