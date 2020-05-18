<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Customer
{
    /**
     * @var int|null $customerId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var int|null $customerGroupId
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId;

    /**
     * @var int|null $storeId
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId = 0;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

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
     * @var string|null $email
     * @ORM\Column(type="string", name="`email`", length=96)
     */
    protected $email;

    /**
     * @var string|null $telephone
     * @ORM\Column(type="string", name="`telephone`", length=32)
     */
    protected $telephone;

    /**
     * @var string|null $fax
     * @ORM\Column(type="string", name="`fax`", length=32)
     */
    protected $fax;

    /**
     * @var string|null $password
     * @ORM\Column(type="string", name="`password`", length=40)
     */
    protected $password;

    /**
     * @var string|null $salt
     * @ORM\Column(type="string", name="`salt`", length=9)
     */
    protected $salt;

    /**
     * @var string|null $cart
     * @ORM\Column(type="string", name="`cart`", nullable=true)
     */
    protected $cart = null;

    /**
     * @var string|null $wishList
     * @ORM\Column(type="string", name="`wishlist`", nullable=true)
     */
    protected $wishList = null;

    /**
     * @var bool|null $newsletter
     * @ORM\Column(type="boolean", name="`newsletter`")
     */
    protected $newsletter = false;

    /**
     * @var int|null $addressId
     * @ORM\Column(type="integer", name="`address_id`")
     */
    protected $addressId = 0;

    /**
     * @var string|null $customField
     * @ORM\Column(type="string", name="`custom_field`")
     */
    protected $customField;

    /**
     * @var string|null $ip
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @var bool|null $safe
     * @ORM\Column(type="boolean", name="`safe`")
     */
    protected $safe;

    /**
     * @var string|null $token
     * @ORM\Column(type="string", name="`token`")
     */
    protected $token;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=40)
     */
    protected $code;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @return int|null
     */
    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    /**
     * @param int $customerGroupId
     * @return Customer
     */
    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     * @return Customer
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     * @return Customer
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

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
     * @return Customer
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
     * @return Customer
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Customer
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return Customer
     */
    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     * @return Customer
     */
    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Customer
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return Customer
     */
    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCart(): ?string
    {
        return $this->cart;
    }

    /**
     * @param string|null $cart
     * @return Customer
     */
    public function setCart(?string $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWishList(): ?string
    {
        return $this->wishList;
    }

    /**
     * @param string|null $wishList
     * @return Customer
     */
    public function setWishList(?string $wishList): self
    {
        $this->wishList = $wishList;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    /**
     * @param bool $newsletter
     * @return Customer
     */
    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    /**
     * @param int $addressId
     * @return Customer
     */
    public function setAddressId(int $addressId): self
    {
        $this->addressId = $addressId;

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
     * @return Customer
     */
    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return Customer
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

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
     * @return Customer
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSafe(): ?bool
    {
        return $this->safe;
    }

    /**
     * @param bool $safe
     * @return Customer
     */
    public function setSafe(bool $safe): self
    {
        $this->safe = $safe;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Customer
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

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
     * @return Customer
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new DateTime('now'));
        }
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTimeInterface $dateAdded
     * @return Customer
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
