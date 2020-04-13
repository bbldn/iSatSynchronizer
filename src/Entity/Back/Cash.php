<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_cash`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\CashRepository")
 */
class Cash extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_num`")
     */
    private $orderNum;

    /**
     * @ORM\Column(type="date", name="`date`")
     */
    private $date;

    /**
     * @ORM\Column(type="float", name="`price`")
     */
    private $price;

    /**
     * @ORM\Column(type="string", name="`currency_name`", length=255)
     */
    private $currencyName;

    /**
     * @ORM\Column(type="float", name="`currency_value`")
     */
    private $currencyValue;

    /**
     * @ORM\Column(type="boolean", name="`synchronize`")
     */
    private $synchronize;

    /**
     * @ORM\Column(type="string", name="`message`", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="string", name="`fio`", length=255)
     */
    private $fio;

    /**
     * @ORM\Column(type="integer", name="`document_id`")
     */
    private $documentId;

    /**
     * @ORM\Column(type="integer", name="`shop_id`")
     */
    private $shopId;

    /**
     * @ORM\Column(type="integer", name="`cash_type_id`")
     */
    private $cashTypeId;

    /**
     * @ORM\Column(type="string", name="`card_num`")
     */
    private $cardNum;

    /**
     * @ORM\Column(type="boolean", name="`cash_out`")
     */
    private $cashOut;

    /**
     * @ORM\Column(type="integer", name="`shipping_order_id`")
     */
    private $shippingOrderId;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getCurrencyName(): ?string
    {
        return $this->currencyName;
    }

    public function setCurrencyName(string $currencyName): self
    {
        $this->currencyName = $currencyName;

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

    public function getSynchronize(): ?bool
    {
        return $this->synchronize;
    }

    public function setSynchronize(bool $synchronize): self
    {
        $this->synchronize = $synchronize;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getDocumentId(): ?int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId): self
    {
        $this->documentId = $documentId;

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

    public function getCashTypeId(): ?int
    {
        return $this->cashTypeId;
    }

    public function setCashTypeId(int $cashTypeId): self
    {
        $this->cashTypeId = $cashTypeId;

        return $this;
    }

    public function getCardNum(): ?string
    {
        return $this->cardNum;
    }

    public function setCardNum(string $cardNum): self
    {
        $this->cardNum = $cardNum;

        return $this;
    }

    public function getCashOut(): ?bool
    {
        return $this->cashOut;
    }

    public function setCashOut(bool $cashOut): self
    {
        $this->cashOut = $cashOut;

        return $this;
    }

    public function getShippingOrderId(): ?int
    {
        return $this->shippingOrderId;
    }

    public function setShippingOrderId(int $shippingOrderId): self
    {
        $this->shippingOrderId = $shippingOrderId;

        return $this;
    }
}
