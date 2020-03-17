<?php

namespace App\Other;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store
{
    protected $availableStatusId = 7;
    protected $notAvailableStatusId = 5;
    protected $defaultLanguageId = 1;
    protected $defaultStoreId = 0;
    protected $defaultLayoutId = 0;
    protected $defaultCategoryFrontId = 0;
    protected $defaultSortOrder = 0;
    protected $defaultAttributeGroupId = 1;
    protected $rootCategories = [0, 1];
    protected $backSiteUrl = 'http://172.17.0.2';
    protected $frontSiteUrl = 'http://172.17.0.3';
    protected $backSitePath = '/home/user/PhpstormProjects/isat.com.ua';
    protected $frontSitePath = '/home/user/PhpstormProjects/uclan.com.ua';

    public function getAvailableStatusId(): int
    {
        return $this->availableStatusId;
    }

    public function getNotAvailableStatusId(): int
    {
        return $this->notAvailableStatusId;
    }

    public function getDefaultLanguageId(): int
    {
        return $this->defaultLanguageId;
    }

    public function getDefaultStoreId(): int
    {
        return $this->defaultStoreId;
    }

    public function getDefaultLayoutId(): int
    {
        return $this->defaultLayoutId;
    }

    public function getDefaultCategoryFrontId(): int
    {
        return $this->defaultCategoryFrontId;
    }

    public function getDefaultSortOrder(): int
    {
        return $this->defaultSortOrder;
    }

    public function getDefaultAttributeGroupId(): int
    {
        return $this->defaultAttributeGroupId;
    }

    public function getRootCategories(): array
    {
        return $this->rootCategories;
    }

    public function getBackSiteUrl(): string
    {
        return $this->backSiteUrl;
    }

    public function getFrontSiteUrl(): string
    {
        return $this->frontSiteUrl;
    }

    public function getBackSitePath(): string
    {
        return $this->backSitePath;
    }

    public function getFrontSitePath(): string
    {
        return $this->frontSitePath;
    }

    public function __construct(ContainerBagInterface $params)
    {
        $this->availableStatusId = $params->get('front.available_status_id');
        $this->notAvailableStatusId = $params->get('front.not_available_status_id');
        $this->defaultLanguageId = $params->get('front.default_language_id');
        $this->defaultStoreId = $params->get('front.default_store_id');
        $this->defaultLayoutId = $params->get('front.default_layout_id');
        $this->defaultCategoryFrontId = $params->get('front.default_category_front_id');
        $this->defaultSortOrder = $params->get('front.default_sort_order');
        $this->defaultAttributeGroupId = $params->get('front.default_attribute_group_id');
        $this->rootCategories = $params->get('front.root_categories');
        $this->frontSitePath = $params->get('front.site_path');
        $this->frontSiteUrl = $params->get('front.site_url');
        $this->backSitePath = $params->get('back.site_path');
        $this->backSiteUrl = $params->get('back.site_url');
    }

}