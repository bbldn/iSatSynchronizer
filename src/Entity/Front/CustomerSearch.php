<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_search`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerSearchRepository")
 */
class CustomerSearch
{
    /**
     * @var int|null $customerSearchId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_search_id`")
     */
    protected $customerSearchId;

    /**
     * @var int|null $storeId
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var int|null $customerId
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var string|null $keyword
     * @ORM\Column(type="string", name="`keyword`", length=255)
     */
    protected $keyword;

    /**
     * @var int|null $categoryId
     * @ORM\Column(type="integer", name="`category_id`", nullable=true)
     */
    protected $categoryId = null;

    /**
     * @var bool|null $subCategory
     * @ORM\Column(type="boolean", name="`sub_category`")
     */
    protected $subCategory;

    /**
     * @var bool|null $description
     * @ORM\Column(type="boolean", name="`description`")
     */
    protected $description;

    /**
     * @var int|null $products
     * @ORM\Column(type="integer", name="`products`")
     */
    protected $products;

    /**
     * @var string|null $ip
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @param int $storeId
     * @param int $languageId
     * @param int $customerId
     * @param string $keyword
     * @param int $categoryId
     * @param bool $subCategory
     * @param string $description
     * @param int $products
     * @param string $ip
     */
    public function fill(
        int $storeId,
        int $languageId,
        int $customerId,
        string $keyword,
        int $categoryId,
        bool $subCategory,
        string $description,
        int $products,
        string $ip
    )
    {
        $this->storeId = $storeId;
        $this->languageId = $languageId;
        $this->customerId = $customerId;
        $this->keyword = $keyword;
        $this->categoryId = $categoryId;
        $this->subCategory = $subCategory;
        $this->description = $description;
        $this->products = $products;
        $this->ip = $ip;
    }

    /**
     * @return int|null
     */
    public function getCustomerSearchId(): ?int
    {
        return $this->customerSearchId;
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
     * @return CustomerSearch
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
     * @return CustomerSearch
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
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
     * @return CustomerSearch
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     * @return CustomerSearch
     */
    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     * @return CustomerSearch
     */
    public function setCategoryId(?int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSubCategory(): ?bool
    {
        return $this->subCategory;
    }

    /**
     * @param bool $subCategory
     * @return CustomerSearch
     */
    public function setSubCategory(bool $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDescription(): ?bool
    {
        return $this->description;
    }

    /**
     * @param bool $description
     * @return CustomerSearch
     */
    public function setDescription(bool $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProducts(): ?int
    {
        return $this->products;
    }

    /**
     * @param int $products
     * @return CustomerSearch
     */
    public function setProducts(int $products): self
    {
        $this->products = $products;

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
     * @return CustomerSearch
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
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
     * @return CustomerSearch
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
