<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_voucher`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderVoucherRepository")
 */
class OrderVoucher
{
    /**
     * @var int|null $orderVoucherId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_voucher_id`")
     */
    protected $orderVoucherId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var int|null $voucherId
     * @ORM\Column(type="integer", name="`voucher_id`")
     */
    protected $voucherId;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`", length=255)
     */
    protected $description;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=10)
     */
    protected $code;

    /**
     * @var string|null $fromName
     * @ORM\Column(type="string", name="`from_name`", length=64)
     */
    protected $fromName;

    /**
     * @var string|null $fromEmail
     * @ORM\Column(type="string", name="`from_email`", length=96)
     */
    protected $fromEmail;

    /**
     * @var string|null $toName
     * @ORM\Column(type="string", name="`to_name`", length=64)
     */
    protected $toName;

    /**
     * @var string|null $toEmail
     * @ORM\Column(type="string", name="`to_email`", length=96)
     */
    protected $toEmail;

    /**
     * @var int|null $voucherThemeId
     * @ORM\Column(type="integer", name="`voucher_theme_id`")
     */
    protected $voucherThemeId;

    /**
     * @var string|null $message
     * @ORM\Column(type="string", name="`message`", length=255)
     */
    protected $message;

    /**
     * @var float|null $amount
     * @ORM\Column(type="float", name="`amount`")
     */
    protected $amount;

    public function fill(
        int $orderId,
        int $voucherId,
        string $description,
        string $code,
        string $fromName,
        string $fromEmail,
        string $toName,
        string $toEmail,
        int $voucherThemeId,
        string $message,
        float $amount)
    {
        $this->orderId = $orderId;
        $this->voucherId = $voucherId;
        $this->description = $description;
        $this->code = $code;
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->toName = $toName;
        $this->toEmail = $toEmail;
        $this->voucherThemeId = $voucherThemeId;
        $this->message = $message;
        $this->amount = $amount;
    }

    /**
     * @return int|null
     */
    public function getOrderVoucherId(): ?int
    {
        return $this->orderVoucherId;
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
     * @return OrderVoucher
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVoucherId(): ?int
    {
        return $this->voucherId;
    }

    /**
     * @param int $voucherId
     * @return OrderVoucher
     */
    public function setVoucherId(int $voucherId): self
    {
        $this->voucherId = $voucherId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return OrderVoucher
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return OrderVoucher
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     * @return OrderVoucher
     */
    public function setFromName(string $fromName): self
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    /**
     * @param string $fromEmail
     * @return OrderVoucher
     */
    public function setFromEmail(string $fromEmail): self
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToName(): ?string
    {
        return $this->toName;
    }

    /**
     * @param string $toName
     * @return OrderVoucher
     */
    public function setToName(string $toName): self
    {
        $this->toName = $toName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    /**
     * @param string $toEmail
     * @return OrderVoucher
     */
    public function setToEmail(string $toEmail): self
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVoucherThemeId(): ?int
    {
        return $this->voucherThemeId;
    }

    /**
     * @param int $voucherThemeId
     * @return OrderVoucher
     */
    public function setVoucherThemeId(int $voucherThemeId): self
    {
        $this->voucherThemeId = $voucherThemeId;

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
     * @return OrderVoucher
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return OrderVoucher
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
