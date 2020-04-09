<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_voucher`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderVoucherRepository")
 */
class OrderVoucher extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_voucher_id`")
     */
    private $orderVoucherId;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="integer", name="`voucher_id`")
     */
    private $voucherId;

    /**
     * @ORM\Column(type="string", name="`description`", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", name="`code`", length=10)
     */
    private $code;

    /**
     * @ORM\Column(type="string", name="`from_name`", length=64)
     */
    private $fromName;

    /**
     * @ORM\Column(type="string", name="`from_email`", length=96)
     */
    private $fromEmail;

    /**
     * @ORM\Column(type="string", name="`to_name`", length=64)
     */
    private $toName;

    /**
     * @ORM\Column(type="string", name="`to_email`", length=96)
     */
    private $toEmail;

    /**
     * @ORM\Column(type="integer", name="`voucher_theme_id`")
     */
    private $voucherThemeId;

    /**
     * @ORM\Column(type="string", name="`message`", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="float", name="`amount`")
     */
    private $amount;

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

    public function setOrderVoucherId(int $orderVoucherId): self
    {
        $this->orderVoucherId = $orderVoucherId;

        return $this;
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
