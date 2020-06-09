<?php

namespace App\Helper\Front;

use App\Helper\Store as StoreBase;
use Illuminate\Support\Str;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    /** @var int|mixed $productAvailableStatusId */
    protected $productAvailableStatusId = 7;

    /** @var int|mixed $productNotAvailableStatusId */
    protected $productNotAvailableStatusId = 5;

    /** @var int|mixed $defaultLanguageId */
    protected $defaultLanguageId = 1;

    /** @var int|mixed $defaultStoreId */
    protected $defaultStoreId = 0;

    /** @var int|mixed $defaultLayoutId */
    protected $defaultLayoutId = 0;

    /** @var int|mixed $defaultCategoryFrontId */
    protected $defaultCategoryFrontId = 0;

    /** @var int|mixed $defaultSortOrder */
    protected $defaultSortOrder = 0;

    /** @var int|mixed $defaultAttributeGroupId */
    protected $defaultAttributeGroupId = 1;

    /** @var int|mixed $defaultOrderStatus */
    protected $defaultOrderStatus = 1;

    /** @var int $defaultShopId */
    protected $defaultShopId = 0;

    /** @var string $defaultCountry */
    protected $defaultCountry = 'Украина';

    /** @var int $defaultCountryId */
    protected $defaultCountryId = 220;

    /** @var string $defaultPaymentMethod */
    protected $defaultPaymentMethod = 'Оплата при доставке';

    /** @var string $defaultShippingMethod */
    protected $defaultShippingMethod = 'Доставка с фиксированной стоимостью';

    /** @var string $defaultShippingCode */
    protected $defaultShippingCode = 'flat.flat';

    /** @var string $defaultCustomField */
    protected $defaultCustomField = '[]';

    /** @var string $invoicePrefix */
    protected $invoicePrefix = 'INV-2020-00';

    /** @var int $defaultCustomerGroupId */
    protected $defaultCustomerGroupId = 1;

    /** @var string $storeName */
    protected $storeName = 'isat.com.ua';

    /** @var string $defaultPaymentCode */
    protected $defaultPaymentCode = 'cod';

    /** @var int $defaultAffiliateId */
    protected $defaultAffiliateId = 0;

    /** @var int $defaultCommission */
    protected $defaultCommission = 0;

    /** @var int $defaultMarketingId */
    protected $defaultMarketingId = 0;

    /** @var int $defaultTax */
    protected $defaultTax = 0;

    /** @var int $defaultReward */
    protected $defaultReward = 0;

    /** @var int $defaultInvoiceNo */
    protected $defaultInvoiceNo = 0;

    /** @var int $defaultCustomerId */
    protected $defaultCustomerId = 0;

    /** @var int $defaultZoneId */
    protected $defaultZoneId = 0;

    /** @var int $defaultManufacturerId */
    protected $defaultManufacturerId = 1;

    /** @var mixed|string $siteUrl */
    protected $siteUrl = 'http://172.17.0.2';

    /** @var mixed|string $sitePath */
    protected $sitePath = '/home/user/PhpstormProjects/uclan.com.ua';

    /** @var string $frontCategoryPath */
    protected $frontCategoryPath = '/date/categories/';

    /**
     * Store constructor.
     * @param ContainerBagInterface $params
     */
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
     * @return Store
     */
    public function setProductAvailableStatusId($productAvailableStatusId): self
    {
        $this->productAvailableStatusId = $productAvailableStatusId;

        return $this;
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
     * @return Store
     */
    public function setProductNotAvailableStatusId($productNotAvailableStatusId): self
    {
        $this->productNotAvailableStatusId = $productNotAvailableStatusId;

        return $this;
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
     * @return Store
     */
    public function setDefaultLanguageId($defaultLanguageId): self
    {
        $this->defaultLanguageId = $defaultLanguageId;

        return $this;
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
     * @return Store
     */
    public function setDefaultStoreId($defaultStoreId): self
    {
        $this->defaultStoreId = $defaultStoreId;

        return $this;
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
     * @return Store
     */
    public function setDefaultLayoutId($defaultLayoutId): self
    {
        $this->defaultLayoutId = $defaultLayoutId;

        return $this;
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
     * @return Store
     */
    public function setDefaultCategoryFrontId($defaultCategoryFrontId): self
    {
        $this->defaultCategoryFrontId = $defaultCategoryFrontId;

        return $this;
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
     * @return Store
     */
    public function setDefaultSortOrder($defaultSortOrder): self
    {
        $this->defaultSortOrder = $defaultSortOrder;

        return $this;
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
     * @return Store
     */
    public function setDefaultAttributeGroupId($defaultAttributeGroupId): self
    {
        $this->defaultAttributeGroupId = $defaultAttributeGroupId;

        return $this;
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
     * @return Store
     */
    public function setDefaultOrderStatus($defaultOrderStatus): self
    {
        $this->defaultOrderStatus = $defaultOrderStatus;

        return $this;
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
     * @return Store
     */
    public function setDefaultShopId(int $defaultShopId): self
    {
        $this->defaultShopId = $defaultShopId;

        return $this;
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
     * @return Store
     */
    public function setDefaultCountry(string $defaultCountry): self
    {
        $this->defaultCountry = $defaultCountry;

        return $this;
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
     * @return Store
     */
    public function setDefaultCountryId(int $defaultCountryId): self
    {
        $this->defaultCountryId = $defaultCountryId;

        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * @param mixed|string $siteUrl
     * @return Store
     */
    public function setSiteUrl($siteUrl): self
    {
        $this->siteUrl = $siteUrl;

        return $this;
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
     * @return Store
     */
    public function setDefaultPaymentMethod(string $defaultPaymentMethod): self
    {
        $this->defaultPaymentMethod = $defaultPaymentMethod;

        return $this;
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
     * @return Store
     */
    public function setDefaultShippingMethod(string $defaultShippingMethod): self
    {
        $this->defaultShippingMethod = $defaultShippingMethod;

        return $this;
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
     * @return Store
     */
    public function setDefaultCustomField(string $defaultCustomField): self
    {
        $this->defaultCustomField = $defaultCustomField;

        return $this;
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
     * @return Store
     */
    public function setDefaultCustomerGroupId(int $defaultCustomerGroupId): self
    {
        $this->defaultCustomerGroupId = $defaultCustomerGroupId;

        return $this;
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
     * @return Store
     */
    public function setDefaultPaymentCode(string $defaultPaymentCode): self
    {
        $this->defaultPaymentCode = $defaultPaymentCode;

        return $this;
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
     * @return Store
     */
    public function setDefaultAffiliateId(int $defaultAffiliateId): self
    {
        $this->defaultAffiliateId = $defaultAffiliateId;

        return $this;
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
     * @return Store
     */
    public function setDefaultCommission(int $defaultCommission): self
    {
        $this->defaultCommission = $defaultCommission;

        return $this;
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
     * @return Store
     */
    public function setDefaultMarketingId(int $defaultMarketingId): self
    {
        $this->defaultMarketingId = $defaultMarketingId;

        return $this;
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
     * @return Store
     */
    public function setDefaultReward(int $defaultReward): self
    {
        $this->defaultReward = $defaultReward;

        return $this;
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
     * @return Store
     */
    public function setDefaultTax(int $defaultTax): self
    {
        $this->defaultTax = $defaultTax;

        return $this;
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
     * @return Store
     */
    public function setDefaultInvoiceNo(int $defaultInvoiceNo): self
    {
        $this->defaultInvoiceNo = $defaultInvoiceNo;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultCustomerId(): int
    {
        return $this->defaultCustomerId;
    }

    /**
     * @param int $defaultCustomerId
     * @return Store
     */
    public function setDefaultCustomerId(int $defaultCustomerId): self
    {
        $this->defaultCustomerId = $defaultCustomerId;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultZoneId(): int
    {
        return $this->defaultZoneId;
    }

    /**
     * @param int $defaultZoneId
     * @return Store
     */
    public function setDefaultZoneId(int $defaultZoneId): self
    {
        $this->defaultZoneId = $defaultZoneId;

        return $this;
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
     * @return Store
     */
    public function setSitePath($sitePath): self
    {
        $this->sitePath = $sitePath;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultManufacturerId(): int
    {
        return $this->defaultManufacturerId;
    }

    /**
     * @param int $defaultManufacturerId
     * @return Store
     */
    public function setDefaultManufacturerId(int $defaultManufacturerId): self
    {
        $this->defaultManufacturerId = $defaultManufacturerId;

        return $this;
    }

    /**
     * @param string $value
     * @param string $salt
     * @return string
     */
    public static function hashPassword(string $value, string $salt): string
    {
        return sha1($salt . sha1($salt . sha1($value)));
    }

    /**
     * @param string $value
     * @return string
     */
    public static function hashPasswordOld(string $value): string
    {
        return md5($value);
    }

    /**
     * @param int $id
     * @param string $name
     * @return string
     */
    public static function generateURL(int $id, string $name): string
    {
        $full = $id . '-' . Str::lower(static::encodingConvert($name));

        $full = preg_replace('/[+,() ]/i', '-', $full);
        $full = preg_replace('/-{1,}/i', '-', $full);
        $full = preg_replace('/\//i', '', $full);
        $full = trim($full, '-');

        return $full;
    }
}