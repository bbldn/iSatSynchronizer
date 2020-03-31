<?php

namespace App\Other\Back;

use App\Other\Store as StoreBase;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    protected $rootCategories = [0, 1];
    protected $siteUrl = 'http://172.17.0.3';
    protected $sitePath = '/home/user/PhpstormProjects/isat.com.ua';
    protected $defaultChatNameColor = '006084';

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