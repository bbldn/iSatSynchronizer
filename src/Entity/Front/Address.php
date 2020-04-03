<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_address`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`address_id`")
     */
    private $addressId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", name="`firstname`", length=32)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="`lastname`", length=32)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", name="`company`", length=40)
     */
    private $company;

    /**
     * @ORM\Column(type="string", name="`address_1`", length=128)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", name="`address_2`", length=128)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", name="`city`", length=128)
     */
    private $city;

    /**
     * @ORM\Column(type="string", name="`postcode`", length=10)
     */
    private $postCode;

    /**
     * @ORM\Column(type="integer", name="`country_id`")
     */
    private $countryId = 0;

    /**
     * @ORM\Column(type="integer", name="`zone_id`")
     */
    private $zoneId = 0;

    /**
     * @ORM\Column(type="string", name="`custom_field`")
     */
    private $customField;

    public function fill(
        int $customerId,
        string $firstName,
        string $lastName,
        string $company,
        string $address1,
        string $address2,
        string $city,
        string $postCode,
        int $countryId,
        int $zoneId,
        string $customField
    )
    {
        $this->customerId = $customerId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->company = $company;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->postCode = $postCode;
        $this->countryId = $countryId;
        $this->zoneId = $zoneId;
        $this->customField = $customField;
    }


    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): self
    {
        $this->addressId = $addressId;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;

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

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getZoneId(): ?int
    {
        return $this->zoneId;
    }

    public function setZoneId(int $zoneId): self
    {
        $this->zoneId = $zoneId;

        return $this;
    }

    public function getCustomField(): ?string
    {
        return $this->customField;
    }

    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

        return $this;
    }
}
