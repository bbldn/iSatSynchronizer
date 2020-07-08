<?php

namespace App\Helper\Back;

use App\Helper\Store as StoreBase;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    /** @var array|mixed $defaultRootCategories */
    protected $defaultRootCategories = [0, 1];

    /** @var int $defaultSiteId */
    protected $defaultSiteId = 0;

    /** @var int $defaultMoneyReal */
    protected $defaultMoneyReal = 0;

    /** @var int $defaultMoneyVirtual */
    protected $defaultMoneyVirtual = 0;

    /** @var int $defaultMoneyBox */
    protected $defaultMoneyBox = 0;

    /** @var int $defaultReferer */
    protected $defaultReferer = 0;

    /** @var int $defaultGroupId */
    protected $defaultGroupId = 0;

    /** @var int $defaultGroupExtraId */
    protected $defaultGroupExtraId = 0;

    /** @var int $defaultDelivery */
    protected $defaultDelivery = 0;

    /** @var int $defaultPayment */
    protected $defaultPayment = 0;

    /** @var int $defaultShopId */
    protected $defaultShopId = 0;

    /** @var mixed|string $defaultSiteUrl */
    protected $defaultSiteUrl = 'http://172.17.0.3';

    /** @var mixed|string $defaultSitePath */
    protected $defaultSitePath = '/home/user/PhpstormProjects/isat.com.ua';

    /** @var string $defaultChatNameColor */
    protected $defaultChatNameColor = '006084';

    /** @var array $defaultImagesPaths */
    protected $defaultImagesPaths = ['/images_big/', '/products_pictures/'];

    /** @var string $defaultRegion */
    protected $defaultRegion = 'Киевская область';

    /** @var string $defaultRegion */
    protected $defaultCity = 'Киев';

    /** @var int $defaultOrderStatusid */
    protected $defaultOrderStatusid = 1;

    /**
     * Store constructor.
     * @param ContainerBagInterface $params
     */
    public function __construct(ContainerBagInterface $params)
    {
        $this->defaultSitePath = (string)$params->get('back.site_path');
        $this->defaultSiteUrl = (string)$params->get('back.site_url');
    }

    /**
     * @return array
     */
    public function getDefaultRootCategories(): array
    {
        return $this->defaultRootCategories;
    }

    /**
     * @param array|mixed $defaultRootCategories
     */
    public function setDefaultRootCategories($defaultRootCategories): void
    {
        $this->defaultRootCategories = $defaultRootCategories;
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
    public function getDefaultSiteUrl(): string
    {
        return $this->defaultSiteUrl;
    }

    /**
     * @param mixed|string $defaultSiteUrl
     */
    public function setDefaultSiteUrl($defaultSiteUrl): void
    {
        $this->defaultSiteUrl = $defaultSiteUrl;
    }

    /**
     * @return mixed|string
     */
    public function getDefaultSitePath(): string
    {
        return $this->defaultSitePath;
    }

    /**
     * @param mixed|string $defaultSitePath
     */
    public function setDefaultSitePath($defaultSitePath): void
    {
        $this->defaultSitePath = $defaultSitePath;
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
     * @return string
     */
    public function getDefaultRegion(): string
    {
        return $this->defaultRegion;
    }

    /**
     * @param string $defaultRegion
     * @return Store
     */
    public function setDefaultRegion(string $defaultRegion): Store
    {
        $this->defaultRegion = $defaultRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultCity(): string
    {
        return $this->defaultCity;
    }

    /**
     * @param string $defaultCity
     * @return Store
     */
    public function setDefaultCity(string $defaultCity): self
    {
        $this->defaultCity = $defaultCity;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultOrderStatusid(): int
    {
        return $this->defaultOrderStatusid;
    }

    /**
     * @param int $defaultOrderStatusid
     * @return Store
     */
    public function setDefaultOrderStatusid(int $defaultOrderStatusid): self
    {
        $this->defaultOrderStatusid = $defaultOrderStatusid;

        return $this;
    }

    /**
     * @return string
     */
    public function generatePassword(): string
    {
        return rand(10000000, 99999999);
    }

    /**
     * @param string $fio
     * @return array
     */
    public static function parseFirstLastName(string $fio): array
    {
        $parsedFio = explode(' ', $fio);

        if (0 === count($parsedFio)) {
            $data = [
                'firstName' => ' ',
                'lastName' => ' ',
            ];
        } elseif (1 === count($parsedFio)) {
            $data = [
                'firstName' => ' ',
                'lastName' => trim($parsedFio[0]),
            ];
        } else {
            $data = [
                'firstName' => trim($parsedFio[1]),
                'lastName' => trim($parsedFio[0]),
            ];
        }

        return $data;
    }
}