<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId = 0;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @ORM\Column(type="string", name="`firstname`", length=32)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", name="`lastname`", length=32)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", name="`email`", length=96)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", name="`telephone`", length=32)
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", name="`fax`", length=32)
     */
    protected $fax;

    /**
     * @ORM\Column(type="string", name="`password`", length=40)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", name="`salt`", length=9)
     */
    protected $salt;

    /**
     * @ORM\Column(type="string", name="`cart`", nullable=true)
     */
    protected $cart = null;

    /**
     * @ORM\Column(type="string", name="`wishlist`", nullable=true)
     */
    protected $wishList = null;

    /**
     * @ORM\Column(type="boolean", name="`newsletter`")
     */
    protected $newsletter = 0;

    /**
     * @ORM\Column(type="integer", name="`address_id`")
     */
    protected $addressId = 0;

    /**
     * @ORM\Column(type="string", name="`custom_field`")
     */
    protected $customField;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @ORM\Column(type="boolean", name="`safe`")
     */
    protected $safe;

    /**
     * @ORM\Column(type="string", name="`token`")
     */
    protected $token;

    /**
     * @ORM\Column(type="string", name="`code`", length=40)
     */
    protected $code;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @ORM\Column(type="string", name="`pass`", nullable=true)
     */
    protected $pass = null;

    /**
     * @param int $customerGroupId
     * @param int $storeId
     * @param int $languageId
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $telephone
     * @param string $fax
     * @param string $password
     * @param string $salt
     * @param null|string $cart
     * @param null|string $wishList
     * @param bool $newsletter
     * @param int $addressId
     * @param string $customField
     * @param string $ip
     * @param bool $status
     * @param bool $safe
     * @param string $token
     * @param string $code
     * @param null|string $pass
     */
    public function fill(
        int $customerGroupId,
        int $storeId,
        int $languageId,
        string $firstName,
        string $lastName,
        string $email,
        string $telephone,
        string $fax,
        string $password,
        string $salt,
        ?string $cart,
        ?string $wishList,
        bool $newsletter,
        int $addressId,
        string $customField,
        string $ip,
        bool $status,
        bool $safe,
        string $token,
        string $code,
        ?string $pass
    )
    {
        $this->customerGroupId = $customerGroupId;
        $this->storeId = $storeId;
        $this->languageId = $languageId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->fax = $fax;
        $this->password = $password;
        $this->salt = $salt;
        $this->cart = $cart;
        $this->wishList = $wishList;
        $this->newsletter = $newsletter;
        $this->addressId = $addressId;
        $this->customField = $customField;
        $this->ip = $ip;
        $this->status = $status;
        $this->safe = $safe;
        $this->token = $token;
        $this->code = $code;
        $this->pass = $pass;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
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

    public function setCart(?string $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getWishList(): ?string
    {
        return $this->wishList;
    }

    public function setWishList(?string $wishList): self
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

    public function getPass(): string
    {
        return $this->pass;
    }

    public function setPass(?string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
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
}
