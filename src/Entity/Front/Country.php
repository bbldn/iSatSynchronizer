<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_country`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CountryRepository")
 */
class Country
{
    /**
     * @var int|null $countryId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`country_id`")
     */
    protected $countryId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=128)
     */
    protected $name;

    /**
     * @var string|null $isoCode2
     * @ORM\Column(type="string", name="`iso_code_2`", length=2)
     */
    protected $isoCode2;

    /**
     * @var string|null $isoCode3
     * @ORM\Column(type="string", name="`iso_code_3`", length=3)
     */
    protected $isoCode3;

    /**
     * @var string|null $addressFormat
     * @ORM\Column(type="text", name="`address_format`")
     */
    protected $addressFormat;

    /**
     * @var bool|null $addressFormat
     * @ORM\Column(type="boolean", name="`postcode_required`")
     */
    protected $postCodeRequired;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status = 1;

    /**
     * @return int|null
     */
    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Country
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsoCode2(): ?string
    {
        return $this->isoCode2;
    }

    /**
     * @param string $isoCode2
     * @return Country
     */
    public function setIsoCode2(string $isoCode2): self
    {
        $this->isoCode2 = $isoCode2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsoCode3(): ?string
    {
        return $this->isoCode3;
    }

    /**
     * @param string $isoCode3
     * @return Country
     */
    public function setIsoCode3(string $isoCode3): self
    {
        $this->isoCode3 = $isoCode3;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressFormat(): ?string
    {
        return $this->addressFormat;
    }

    /**
     * @param string $addressFormat
     * @return Country
     */
    public function setAddressFormat(string $addressFormat): self
    {
        $this->addressFormat = $addressFormat;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPostCodeRequired(): ?bool
    {
        return $this->postCodeRequired;
    }

    /**
     * @param bool $postCodeRequired
     * @return Country
     */
    public function setPostCodeRequired(bool $postCodeRequired): self
    {
        $this->postCodeRequired = $postCodeRequired;

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
     * @return Country
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
