<?php

namespace App\Helper\Back;

use App\Helper\Store as StoreBase;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    protected $rootCategories = [0, 1];
    protected $defaultSiteId = 0;
    protected $defaultMoneyReal = 0;
    protected $defaultMoneyVirtual = 0;
    protected $defaultMoneyBox = 0;
    protected $defaultReferer = 0;
    protected $defaultGroupId = 0;
    protected $defaultGroupExtraId = 0;
    protected $defaultDelivery = 0;
    protected $defaultPayment = 0;
    protected $defaultShopId = 0;
    protected $siteUrl = 'http://172.17.0.3';
    protected $sitePath = '/home/user/PhpstormProjects/isat.com.ua';
    protected $defaultChatNameColor = '006084';

    /**
     * Store constructor.
     * @param ContainerBagInterface $params
     */
    public function __construct(ContainerBagInterface $params)
    {
        $this->rootCategories = $params->get('front.root_categories');
        $this->sitePath = $params->get('back.site_path');
        $this->siteUrl = $params->get('back.site_url');
    }

    /**
     * @return array|mixed
     */
    public function getRootCategories(): array
    {
        return $this->rootCategories;
    }

    /**
     * @param array|mixed $rootCategories
     */
    public function setRootCategories($rootCategories): void
    {
        $this->rootCategories = $rootCategories;
    }

    /**
     * @return int
     */
    public function getDefaultSiteId(): int
    {
        return $this->defaultSiteId;
    }

    /**
     * @param int $defaultSiteId
     */
    public function setDefaultSiteId(int $defaultSiteId): void
    {
        $this->defaultSiteId = $defaultSiteId;
    }

    /**
     * @return int
     */
    public function getDefaultMoneyReal(): int
    {
        return $this->defaultMoneyReal;
    }

    /**
     * @param int $defaultMoneyReal
     */
    public function setDefaultMoneyReal(int $defaultMoneyReal): void
    {
        $this->defaultMoneyReal = $defaultMoneyReal;
    }

    /**
     * @return int
     */
    public function getDefaultMoneyVirtual(): int
    {
        return $this->defaultMoneyVirtual;
    }

    /**
     * @param int $defaultMoneyVirtual
     */
    public function setDefaultMoneyVirtual(int $defaultMoneyVirtual): void
    {
        $this->defaultMoneyVirtual = $defaultMoneyVirtual;
    }

    /**
     * @return int
     */
    public function getDefaultMoneyBox(): int
    {
        return $this->defaultMoneyBox;
    }

    /**
     * @param int $defaultMoneyBox
     */
    public function setDefaultMoneyBox(int $defaultMoneyBox): void
    {
        $this->defaultMoneyBox = $defaultMoneyBox;
    }

    /**
     * @return int
     */
    public function getDefaultReferer(): int
    {
        return $this->defaultReferer;
    }

    /**
     * @param int $defaultReferer
     */
    public function setDefaultReferer(int $defaultReferer): void
    {
        $this->defaultReferer = $defaultReferer;
    }

    /**
     * @return int
     */
    public function getDefaultGroupId(): int
    {
        return $this->defaultGroupId;
    }

    /**
     * @param int $defaultGroupId
     */
    public function setDefaultGroupId(int $defaultGroupId): void
    {
        $this->defaultGroupId = $defaultGroupId;
    }

    /**
     * @return int
     */
    public function getDefaultGroupExtraId(): int
    {
        return $this->defaultGroupExtraId;
    }

    /**
     * @param int $defaultGroupExtraId
     */
    public function setDefaultGroupExtraId(int $defaultGroupExtraId): void
    {
        $this->defaultGroupExtraId = $defaultGroupExtraId;
    }

    /**
     * @return int
     */
    public function getDefaultDelivery(): int
    {
        return $this->defaultDelivery;
    }

    /**
     * @param int $defaultDelivery
     */
    public function setDefaultDelivery(int $defaultDelivery): void
    {
        $this->defaultDelivery = $defaultDelivery;
    }

    /**
     * @return int
     */
    public function getDefaultPayment(): int
    {
        return $this->defaultPayment;
    }

    /**
     * @param int $defaultPayment
     */
    public function setDefaultPayment(int $defaultPayment): void
    {
        $this->defaultPayment = $defaultPayment;
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
     * @return mixed|string
     */
    public function getSiteUrl(): string
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
    public function getSitePath(): string
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

    /**
     * @return string
     */
    public function getDefaultChatNameColor(): string
    {
        return $this->defaultChatNameColor;
    }

    /**
     * @param string $defaultChatNameColor
     */
    public function setDefaultChatNameColor(string $defaultChatNameColor): void
    {
        $this->defaultChatNameColor = $defaultChatNameColor;
    }

    /**
     * @param string $fio
     * @return array
     */
    public static function parseFirstLastName(string $fio): array
    {
        $result = [
            'firstName' => ' ',
            'lastName' => ' ',
        ];

        $fullName = explode(' ', $fio);
        if (count($fullName) > 1) {
            $result['lastName'] = trim($fullName[0]);
            $result['firstName'] = trim($fullName[1]);
        } elseif (count($fullName) == 1) {
            $result['lastName'] = trim($fullName[0]);
        }

        return $result;
    }
}