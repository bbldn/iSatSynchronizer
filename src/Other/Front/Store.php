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
    protected $defaultShop = 0;
    protected $siteUrl = 'http://172.17.0.3';
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
    public function getDefaultShop(): int
    {
        return $this->defaultShop;
    }

    /**
     * @param int $defaultShop
     */
    public function setDefaultShop(int $defaultShop): void
    {
        $this->defaultShop = $defaultShop;
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

    public static function convertCurrency(string $currency)
    {
        switch (mb_strtolower(trim($currency))) {
            case 'uah':
            case 'ua':
                return 'грн';
            case 'rub':
            case 'ru':
                return 'р';
            case 'usd':
                return '$';
            case 'eur':
                return '€';
            default:
                return '';
        }
    }
}