<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_search`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerSearchRepository")
 */
class CustomerSearch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_search_id`")
     */
    protected $customerSearchId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @ORM\Column(type="string", name="`keyword`", length=255)
     */
    protected $keyword;

    /**
     * @ORM\Column(type="integer", name="`category_id`", nullable=true)
     */
    protected $categoryId = null;

    /**
     * @ORM\Column(type="boolean", name="`sub_category`")
     */
    protected $subCategory;

    /**
     * @ORM\Column(type="boolean", name="`description`")
     */
    protected $description;

    /**
     * @ORM\Column(type="integer", name="`products`")
     */
    protected $products;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
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

    public function getCustomerSearchId(): ?int
    {
        return $this->customerSearchId;
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

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getSubCategory(): ?bool
    {
        return $this->subCategory;
    }

    public function setSubCategory(bool $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    public function getDescription(): ?bool
    {
        return $this->description;
    }

    public function setDescription(bool $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProducts(): ?int
    {
        return $this->products;
    }

    public function setProducts(int $products): self
    {
        $this->products = $products;

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
