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
     * @var int|null $addressId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`address_id`")
     */
    protected $addressId;

    /**
     * @var int|null $customerId
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var string|null $firstName
     * @ORM\Column(type="string", name="`firstname`", length=32)
     */
    protected $firstName;

    /**
     * @var string|null $lastName
     * @ORM\Column(type="string", name="`lastname`", length=32)
     */
    protected $lastName;

    /**
     * @var string|null $company
     * @ORM\Column(type="string", name="`company`", length=40)
     */
    protected $company;

    /**
     * @var string|null $address1
     * @ORM\Column(type="string", name="`address_1`", length=128)
     */
    protected $address1;

    /**
     * @var string|null $address2
     * @ORM\Column(type="string", name="`address_2`", length=128)
     */
    protected $address2;

    /**
     * @var string|null $city
     * @ORM\Column(type="string", name="`city`", length=128)
     */
    protected $city;

    /**
     * @var string|null $postCode
     * @ORM\Column(type="string", name="`postcode`", length=10)
     */
    protected $postCode;

    /**
     * @var int|null $countryId
     * @ORM\Column(type="integer", name="`country_id`")
     */
    protected $countryId = 0;

    /**
     * @var int|null $zoneId
     * @ORM\Column(type="integer", name="`zone_id`")
     */
    protected $zoneId = 0;

    /**
     * @var string|null $customField
     * @ORM\Column(type="string", name="`custom_field`")
     */
    protected $customField;

    /**
     * @return int|null
     */
    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return Address
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Address
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Address
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return Address
     */
    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     * @return Address
     */
    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     * @return Address
     */
    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     * @return Address
     */
    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     * @return Address
     */
    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getZoneId(): ?int
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     * @return Address
     */
    public function setZoneId(int $zoneId): self
    {
        $this->zoneId = $zoneId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomField(): ?string
    {
        return $this->customField;
    }

    /**
     * @param string $customField
     * @return Address
     */
    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

        return $this;
    }
}
