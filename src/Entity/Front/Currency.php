<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_currency`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CurrencyRepository")
 */
class Currency
{
    /**
     * @var int|null $currencyId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`currency_id`")
     */
    protected $currencyId;

    /**
     * @var string|null $title
     * @ORM\Column(type="string", name="`title`", length=32)
     */
    protected $title;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=3)
     */
    protected $code;

    /**
     * @var string|null $symbolLeft
     * @ORM\Column(type="string", name="`symbol_left`", length=12)
     */
    protected $symbolLeft;

    /**
     * @var string|null $symbolRight
     * @ORM\Column(type="string", name="`symbol_right`", length=12)
     */
    protected $symbolRight;

    /**
     * @var int|null $decimalPlace
     * @ORM\Column(type="integer", name="`decimal_place`")
     */
    protected $decimalPlace;

    /**
     * @var float|null $value
     * @ORM\Column(type="float", name="`value`")
     */
    protected $value;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @var DateTimeInterface|null $dateModified
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    protected $dateModified;

    /**
     * @param string $title
     * @param string $code
     * @param string $symbolLeft
     * @param string $symbolRight
     * @param int $decimalPlace
     * @param float $value
     * @param bool $status
     */
    public function fill(
        string $title,
        string $code,
        string $symbolLeft,
        string $symbolRight,
        int $decimalPlace,
        float $value,
        bool $status
    )
    {
        $this->title = $title;
        $this->code = $code;
        $this->symbolLeft = $symbolLeft;
        $this->symbolRight = $symbolRight;
        $this->decimalPlace = $decimalPlace;
        $this->value = $value;
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Currency
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @return Currency
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSymbolLeft(): ?string
    {
        return $this->symbolLeft;
    }

    /**
     * @param string $symbolLeft
     * @return Currency
     */
    public function setSymbolLeft(string $symbolLeft): self
    {
        $this->symbolLeft = $symbolLeft;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSymbolRight(): ?string
    {
        return $this->symbolRight;
    }

    /**
     * @param string $symbolRight
     * @return Currency
     */
    public function setSymbolRight(string $symbolRight): self
    {
        $this->symbolRight = $symbolRight;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDecimalPlace(): ?int
    {
        return $this->decimalPlace;
    }

    /**
     * @param int $decimalPlace
     * @return Currency
     */
    public function setDecimalPlace(int $decimalPlace): self
    {
        $this->decimalPlace = $decimalPlace;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Currency
     */
    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return Currency
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
     * @return Currency
     */
    public function setDateModified(DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }
}
