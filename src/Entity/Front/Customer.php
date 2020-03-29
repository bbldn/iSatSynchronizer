<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    private $customerGroupId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    private $storeId = 0;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="`firstname`", length=32)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="`lastname`", length=32)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", name="`email`", length=96)
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="`telephone`", length=32)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", name="`fax`", length=32)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", name="`password`", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", name="`salt`", length=9)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", name="`cart`")
     */
    private $cart;

    /**
     * @ORM\Column(type="string", name="`wishlist`")
     */
    private $wishList;

    /**
     * @ORM\Column(type="boolean", name="`newsletter`")
     */
    private $newsletter = 0;

    /**
     * @ORM\Column(type="integer", name="`address_id`")
     */
    private $addressId = 0;

    /**
     * @ORM\Column(type="string", name="`custom_field`")
     */
    private $customField;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    private $ip;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean", name="`approved`")
     */
    private $approved;

    /**
     * @ORM\Column(type="boolean", name="`safe`")
     */
    private $safe;

    /**
     * @ORM\Column(type="string", name="`token`")
     */
    private $token;

    /**
     * @ORM\Column(type="string", name="`code`", length=40)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @ORM\Column(type="string", name="`pass`")
     */
    private $pass = null;

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getCart(): ?string
    {
        return $this->cart;
    }

    public function setCart(string $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getWishList(): ?string
    {
        return $this->wishList;
    }

    public function setWishList(string $wishList): self
    {
        $this->wishList = $wishList;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
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

    public function getCustomField(): ?string
    {
        return $this->customField;
    }

    public function setCustomField(string $customField): self
    {
        $this->customField = $customField;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

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

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

    public function getSafe(): ?bool
    {
        return $this->safe;
    }

    public function setSafe(bool $safe): self
    {
        $this->safe = $safe;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function setPass($pass): void
    {
        $this->pass = $pass;
    }
}
