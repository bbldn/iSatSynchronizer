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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_voucher_id`")
     */
    protected $orderVoucherId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @ORM\Column(type="integer", name="`voucher_id`")
     */
    protected $voucherId;

    /**
     * @ORM\Column(type="string", name="`description`", length=255)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", name="`code`", length=10)
     */
    protected $code;

    /**
     * @ORM\Column(type="string", name="`from_name`", length=64)
     */
    protected $fromName;

    /**
     * @ORM\Column(type="string", name="`from_email`", length=96)
     */
    protected $fromEmail;

    /**
     * @ORM\Column(type="string", name="`to_name`", length=64)
     */
    protected $toName;

    /**
     * @ORM\Column(type="string", name="`to_email`", length=96)
     */
    protected $toEmail;

    /**
     * @ORM\Column(type="integer", name="`voucher_theme_id`")
     */
    protected $voucherThemeId;

    /**
     * @ORM\Column(type="string", name="`message`", length=255)
     */
    protected $message;

    /**
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

    public function getOrderVoucherId(): ?int
    {
        return $this->orderVoucherId;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getVoucherId(): ?int
    {
        return $this->voucherId;
    }

    public function setVoucherId(int $voucherId): self
    {
        $this->voucherId = $voucherId;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    public function setFromName(string $fromName): self
    {
        $this->fromName = $fromName;

        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(string $fromEmail): self
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    public function getToName(): ?string
    {
        return $this->toName;
    }

    public function setToName(string $toName): self
    {
        $this->toName = $toName;

        return $this;
    }

    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    public function setToEmail(string $toEmail): self
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    public function getVoucherThemeId(): ?int
    {
        return $this->voucherThemeId;
    }

    public function setVoucherThemeId(int $voucherThemeId): self
    {
        $this->voucherThemeId = $voucherThemeId;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
