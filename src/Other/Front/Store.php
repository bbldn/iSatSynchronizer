<?php

namespace App\Other\Front;

use App\Other\Store as StoreBase;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    protected $productAvailableStatusId = 7;
    protected $productNotAvailableStatusId = 5;
    protected $defaultLanguageId = 1;
    protected $defaultStoreId = 0;
    protected $defaultLayoutId = 0;
    protected $defaultCategoryFrontId = 0;
    protected $defaultSortOrder = 0;
    protected $defaultAttributeGroupId = 1;
    protected $defaultOrderStatus = 1;
    protected $defaultShopId = 0;
    protected $defaultCountry = 'Украина';
    protected $defaultCountryId = 220;
    protected $defaultPaymentMethod = 'Оплата при доставке';
    protected $defaultShippingMethod = 'Доставка с фиксированной стоимостью';
    protected $defaultShippingCode = 'flat.flat';
    protected $defaultCustomField = '[]';
    protected $invoicePrefix = 'INV-2020-00';
    protected $defaultCustomerGroupId = 1;
    protected $storeName = 'uclan.com.ua';
    protected $defaultPaymentCode = 'cod';
    protected $defaultAffiliateId = 0;
    protected $defaultCommission = 0;
    protected $defaultMarketingId = 0;
    protected $defaultTax = 0;
    protected $defaultReward = 0;
    protected $defaultInvoiceNo = 0;
    protected $siteUrl = 'http://172.17.0.2';
    protected $sitePath = '/home/user/PhpstormProjects/uclan.com.ua';

    public function __construct(ContainerBagInterface $params)
    {
        $this->productAvailableStatusId = $params->get('front.available_status_id');
        $this->productNotAvailableStatusId = $params->get('front.not_available_status_id');
        $this->defaultLanguageId = $params->get('front.default_language_id');
        $this->defaultStoreId = $params->get('front.default_store_id');
        $this->defaultLayoutId = $params->get('front.default_layout_id');
        $this->defaultCategoryFrontId = $params->get('front.default_category_front_id');
        $this->defaultSortOrder = $params->get('front.default_sort_order');
        $this->defaultAttributeGroupId = $params->get('front.default_attribute_group_id');
        $this->defaultOrderStatus = $params->get('back.default_order_status');
        $this->sitePath = $params->get('front.site_path');
        $this->siteUrl = $params->get('front.site_url');
    }

    /**
     * @return int|mixed
     */
    public function getProductAvailableStatusId()
    {
        return $this->productAvailableStatusId;
    }

    /**
     * @param int|mixed $productAvailableStatusId
     */
    public function setProductAvailableStatusId($productAvailableStatusId): void
    {
        $this->productAvailableStatusId = $productAvailableStatusId;
    }

    /**
     * @return int|mixed
     */
    public function getProductNotAvailableStatusId()
    {
        return $this->productNotAvailableStatusId;
    }

    /**
     * @param int|mixed $productNotAvailableStatusId
     */
    public function setProductNotAvailableStatusId($productNotAvailableStatusId): void
    {
        $this->productNotAvailableStatusId = $productNotAvailableStatusId;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultLanguageId()
    {
        return $this->defaultLanguageId;
    }

    /**
     * @param int|mixed $defaultLanguageId
     */
    public function setDefaultLanguageId($defaultLanguageId): void
    {
        $this->defaultLanguageId = $defaultLanguageId;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultStoreId()
    {
        return $this->defaultStoreId;
    }

    /**
     * @param int|mixed $defaultStoreId
     */
    public function setDefaultStoreId($defaultStoreId): void
    {
        $this->defaultStoreId = $defaultStoreId;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultLayoutId()
    {
        return $this->defaultLayoutId;
    }

    /**
     * @param int|mixed $defaultLayoutId
     */
    public function setDefaultLayoutId($defaultLayoutId): void
    {
        $this->defaultLayoutId = $defaultLayoutId;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultCategoryFrontId()
    {
        return $this->defaultCategoryFrontId;
    }

    /**
     * @param int|mixed $defaultCategoryFrontId
     */
    public function setDefaultCategoryFrontId($defaultCategoryFrontId): void
    {
        $this->defaultCategoryFrontId = $defaultCategoryFrontId;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultSortOrder()
    {
        return $this->defaultSortOrder;
    }

    /**
     * @param int|mixed $defaultSortOrder
     */
    public function setDefaultSortOrder($defaultSortOrder): void
    {
        $this->defaultSortOrder = $defaultSortOrder;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultAttributeGroupId()
    {
        return $this->defaultAttributeGroupId;
    }

    /**
     * @param int|mixed $defaultAttributeGroupId
     */
    public function setDefaultAttributeGroupId($defaultAttributeGroupId): void
    {
        $this->defaultAttributeGroupId = $defaultAttributeGroupId;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultOrderStatus()
    {
        return $this->defaultOrderStatus;
    }

    /**
     * @param int|mixed $defaultOrderStatus
     */
    public function setDefaultOrderStatus($defaultOrderStatus): void
    {
        $this->defaultOrderStatus = $defaultOrderStatus;
    }

    /**
     * @return int
     */
    public function getDefaultShopId(): int
    {
        return $this->defaultShopId;
    }

    /**
     * @param int $defaultShopId
     */
    public function setDefaultShopId(int $defaultShopId): void
    {
        $this->defaultShopId = $defaultShopId;
    }

    /**
     * @return string
     */
    public function getDefaultCountry(): string
    {
        return $this->defaultCountry;
    }

    /**
     * @param string $defaultCountry
     */
    public function setDefaultCountry(string $defaultCountry): void
    {
        $this->defaultCountry = $defaultCountry;
    }

    /**
     * @return int
     */
    public function getDefaultCountryId(): int
    {
        return $this->defaultCountryId;
    }

    /**
     * @param int $defaultCountryId
     */
    public function setDefaultCountryId(int $defaultCountryId): void
    {
        $this->defaultCountryId = $defaultCountryId;
    }

    /**
     * @return mixed|string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * @return string
     */
    public function getDefaultPaymentMethod(): string
    {
        return $this->defaultPaymentMethod;
    }

    /**
     * @param string $defaultPaymentMethod
     */
    public function setDefaultPaymentMethod(string $defaultPaymentMethod): void
    {
        $this->defaultPaymentMethod = $defaultPaymentMethod;
    }

    /**
     * @return string
     */
    public function getDefaultShippingMethod(): string
    {
        return $this->defaultShippingMethod;
    }

    /**
     * @param string $defaultShippingMethod
     */
    public function setDefaultShippingMethod(string $defaultShippingMethod): void
    {
        $this->defaultShippingMethod = $defaultShippingMethod;
    }

    /**
     * @return string
     */
    public function getDefaultShippingCode(): string
    {
        return $this->defaultShippingCode;
    }

    /**
     * @param string $defaultShippingCode
     * @return Store
     */
    public function setDefaultShippingCode(string $defaultShippingCode): self
    {
        $this->defaultShippingCode = $defaultShippingCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultCustomField(): string
    {
        return $this->defaultCustomField;
    }

    /**
     * @return string
     */
    public function getInvoicePrefix(): string
    {
        return $this->invoicePrefix;
    }

    /**
     * @param string $invoicePrefix
     * @return Store
     */
    public function setInvoicePrefix(string $invoicePrefix): self
    {
        $this->invoicePrefix = $invoicePrefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->storeName;
    }

    /**
     * @param string $storeName
     * @return Store
     */
    public function setStoreName(string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }

    /**
     * @param string $defaultCustomField
     */
    public function setDefaultCustomField(string $defaultCustomField): void
    {
        $this->defaultCustomField = $defaultCustomField;
    }

    /**
     * @return int
     */
    public function getDefaultCustomerGroupId(): int
    {
        return $this->defaultCustomerGroupId;
    }

    /**
     * @param int $defaultCustomerGroupId
     */
    public function setDefaultCustomerGroupId(int $defaultCustomerGroupId): void
    {
        $this->defaultCustomerGroupId = $defaultCustomerGroupId;
    }

    /**
     * @return string
     */
    public function getDefaultPaymentCode(): string
    {
        return $this->defaultPaymentCode;
    }

    /**
     * @param string $defaultPaymentCode
     */
    public function setDefaultPaymentCode(string $defaultPaymentCode): void
    {
        $this->defaultPaymentCode = $defaultPaymentCode;
    }

    /**
     * @return int
     */
    public function getDefaultAffiliateId(): int
    {
        return $this->defaultAffiliateId;
    }

    /**
     * @param int $defaultAffiliateId
     */
    public function setDefaultAffiliateId(int $defaultAffiliateId): void
    {
        $this->defaultAffiliateId = $defaultAffiliateId;
    }

    /**
     * @return int
     */
    public function getDefaultCommission(): int
    {
        return $this->defaultCommission;
    }

    /**
     * @param int $defaultCommission
     */
    public function setDefaultCommission(int $defaultCommission): void
    {
        $this->defaultCommission = $defaultCommission;
    }

    /**
     * @return int
     */
    public function getDefaultMarketingId(): int
    {
        return $this->defaultMarketingId;
    }

    /**
     * @param int $defaultMarketingId
     */
    public function setDefaultMarketingId(int $defaultMarketingId): void
    {
        $this->defaultMarketingId = $defaultMarketingId;
    }

    /**
     * @return int
     */
    public function getDefaultReward(): int
    {
        return $this->defaultReward;
    }

    /**
     * @param int $defaultReward
     */
    public function setDefaultReward(int $defaultReward): void
    {
        $this->defaultReward = $defaultReward;
    }

    /**
     * @return int
     */
    public function getDefaultTax(): int
    {
        return $this->defaultTax;
    }

    /**
     * @param int $defaultTax
     */
    public function setDefaultTax(int $defaultTax): void
    {
        $this->defaultTax = $defaultTax;
    }

    /**
     * @return int
     */
    public function getDefaultInvoiceNo(): int
    {
        return $this->defaultInvoiceNo;
    }

    /**
     * @param int $defaultInvoiceNo
     */
    public function setDefaultInvoiceNo(int $defaultInvoiceNo): void
    {
        $this->defaultInvoiceNo = $defaultInvoiceNo;
    }

    /**
     * @param mixed|string $siteUrl
     */
    public function setSiteUrl($siteUrl): void
    {
        $this->siteUrl = $siteUrl;
    }

    /**
     * @return mixed|string
     */
    public function getSitePath()
    {
        return $this->sitePath;
    }

    /**
     * @param mixed|string $sitePath
     */
    public function setSitePath($sitePath): void
    {
        $this->sitePath = $sitePath;
    }

    public static function hashPassword(string $value, string $salt)
    {
        return sha1($salt . sha1($salt . sha1($value)));
    }

    public static function hashPasswordOld(string $value)
    {
        return md5($value);
    }
}