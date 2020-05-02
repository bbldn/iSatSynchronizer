<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_currency`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CurrencyRepository")
 */
class Currency
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`currency_id`")
     */
    protected $currencyId;

    /**
     * @ORM\Column(type="string", name="`title`", length=32)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", name="`code`", length=3)
     */
    protected $code;

    /**
     * @ORM\Column(type="string", name="`symbol_left`", length=12)
     */
    protected $symbolLeft;

    /**
     * @ORM\Column(type="string", name="`symbol_right`", length=12)
     */
    protected $symbolRight;

    /**
     * @ORM\Column(type="integer", name="`decimal_place`")
     */
    protected $decimalPlace;

    /**
     * @ORM\Column(type="float", name="`value`")
     */
    protected $value;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
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

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getSymbolLeft(): ?string
    {
        return $this->symbolLeft;
    }

    public function setSymbolLeft(string $symbolLeft): self
    {
        $this->symbolLeft = $symbolLeft;

        return $this;
    }

    public function getSymbolRight(): ?string
    {
        return $this->symbolRight;
    }

    public function setSymbolRight(string $symbolRight): self
    {
        $this->symbolRight = $symbolRight;

        return $this;
    }

    public function getDecimalPlace(): ?int
    {
        return $this->decimalPlace;
    }

    public function setDecimalPlace(int $decimalPlace): self
    {
        $this->decimalPlace = $decimalPlace;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
}
