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
    private $customerSearchId;

    /**
     * @ORM\Column(type="integer", name="`store_id`")
     */
    private $storeId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", name="`keyword`", length=255)
     */
    private $keyword;

    /**
     * @ORM\Column(type="integer", name="`category_id`", nullable=true)
     */
    private $categoryId;

    /**
     * @ORM\Column(type="boolean", name="`sub_category`")
     */
    private $subCategory;

    /**
     * @ORM\Column(type="boolean", name="`description`")
     */
    private $description;

    /**
     * @ORM\Column(type="integer", name="`products`")
     */
    private $products;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    private $ip;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    public function getCustomerSearchId(): ?int
    {
        return $this->customerSearchId;
    }

    public function setCustomerSearchId(int $customerSearchId): self
    {
        $this->customerSearchId = $customerSearchId;

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
