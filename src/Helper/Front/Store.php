<?php

namespace App\Helper\Front;

use App\Helper\Store as StoreBase;
use Illuminate\Support\Str;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    /** @var int|mixed $defaultProductAvailableStatusId */
    protected $defaultProductAvailableStatusId = 7;

    /** @var int|mixed $defaultProductNotAvailableStatusId */
    protected $defaultProductNotAvailableStatusId = 5;

    /** @var int|mixed $defaultLanguageId */
    protected $defaultLanguageId = 1;

    /** @var int|mixed $defaultStoreId */
    protected $defaultStoreId = 0;

    /** @var int|mixed $defaultLayoutId */
    protected $defaultLayoutId = 1;

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

    /** @var string $defaultInvoicePrefix */
    protected $defaultInvoicePrefix = 'INV-2020-00';

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

    /** @var mixed|string $defaultSiteUrl */
    protected $defaultSiteUrl = 'http://172.17.0.2';

    /** @var mixed|string $defaultSitePath */
    protected $defaultSitePath = '/home/user/PhpstormProjects/uclan.com.ua';

    /** @var string $defaultCategoryPath */
    protected $defaultCategoryPath = '/date/categories/';

    /** @var int $defaultQuantity */
    protected $defaultQuantity = 1;

    /** @var int $defaultPriority */
    protected $defaultPriority = 999;

    /** @var int $defaultProductLayoutId */
    protected $defaultProductLayoutId = 2;

    /** @var int $defaultCategoryLayoutId */
    protected $defaultCategoryLayoutId = 3;

    /**
     * Store constructor.
     * @param ContainerBagInterface $bag
     */
    public function __construct(ContainerBagInterface $bag)
    {
        $this->defaultSitePath = (string)$bag->get('front.site_path');
        $this->defaultSiteUrl = (string)$bag->get('front.site_url');
    }

    /**
     * @return int|mixed
     */
    public function getDefaultProductAvailableStatusId()
    {
        return $this->defaultProductAvailableStatusId;
    }

    /**
     * @param int|mixed $defaultProductAvailableStatusId
     * @return Store
     */
    public function setDefaultProductAvailableStatusId($defaultProductAvailableStatusId): self
    {
        $this->defaultProductAvailableStatusId = $defaultProductAvailableStatusId;

        return $this;
    }

    /**
     * @return int|mixed
     */
    public function getDefaultProductNotAvailableStatusId()
    {
        return $this->defaultProductNotAvailableStatusId;
    }

    /**
     * @param int|mixed $defaultProductNotAvailableStatusId
     * @return Store
     */
    public function setDefaultProductNotAvailableStatusId($defaultProductNotAvailableStatusId): self
    {
        $this->defaultProductNotAvailableStatusId = $defaultProductNotAvailableStatusId;

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
    public function getDefaultSiteUrl()
    {
        return $this->defaultSiteUrl;
    }

    /**
     * @param mixed|string $defaultSiteUrl
     * @return Store
     */
    public function setDefaultSiteUrl($defaultSiteUrl): self
    {
        $this->defaultSiteUrl = $defaultSiteUrl;

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
    public function getDefaultInvoicePrefix(): string
    {
        return $this->defaultInvoicePrefix;
    }

    /**
     * @param string $defaultInvoicePrefix
     * @return Store
     */
    public function setDefaultInvoicePrefix(string $defaultInvoicePrefix): self
    {
        $this->defaultInvoicePrefix = $defaultInvoicePrefix;

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
    public function getDefaultSitePath()
    {
        return $this->defaultSitePath;
    }

    /**
     * @param mixed|string $defaultSitePath
     * @return Store
     */
    public function setDefaultSitePath($defaultSitePath): self
    {
        $this->defaultSitePath = $defaultSitePath;

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
     * @return int
     */
    public function getDefaultQuantity(): int
    {
        return $this->defaultQuantity;
    }

    /**
     * @param int $defaultQuantity
     * @return Store
     */
    public function setDefaultQuantity(int $defaultQuantity): self
    {
        $this->defaultQuantity = $defaultQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultPriority(): int
    {
        return $this->defaultPriority;
    }

    /**
     * @param int $defaultPriority
     * @return Store
     */
    public function setDefaultPriority(int $defaultPriority): self
    {
        $this->defaultPriority = $defaultPriority;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultProductLayoutId(): int
    {
        return $this->defaultProductLayoutId;
    }

    /**
     * @param int $defaultProductLayoutId
     * @return Store
     */
    public function setDefaultProductLayoutId(int $defaultProductLayoutId): self
    {
        $this->defaultProductLayoutId = $defaultProductLayoutId;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultCategoryLayoutId(): int
    {
        return $this->defaultCategoryLayoutId;
    }

    /**
     * @param int $defaultCategoryLayoutId
     * @return Store
     */
    public function setDefaultCategoryLayoutId(int $defaultCategoryLayoutId): self
    {
        $this->defaultCategoryLayoutId = $defaultCategoryLayoutId;

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
     * @param string $separator
     * @return string
     */
    public static function generateURL(int $id, string $name, string $separator = '-'): string
    {
        $name = trim(mb_substr($name, 0, 70));
        $name = Str::lower(static::encodingConvert($name));
        $name = str_replace(['\\', '\'', '/', '+', '%', '?'], '', $name);
        $name = str_replace(['.', ',', ' ', '(', ')'], $separator, $name);
        $name = str_replace($separator . $separator, $separator, $name);
        $name = mb_substr($name, 0, 55);
        $name = str_ireplace('%2f', '/', urlencode($name));

        return "{$id}{$separator}{$name}";
    }
}