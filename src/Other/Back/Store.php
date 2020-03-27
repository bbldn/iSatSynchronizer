<?php

namespace App\Other\Back;

use App\Other\Store as StoreBase;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Store extends StoreBase
{
    protected $rootCategories = [0, 1];
    protected $siteUrl = 'http://172.17.0.2';
    protected $sitePath = '/home/user/PhpstormProjects/isat.com.ua';

    public function __construct(ContainerBagInterface $params)
    {
        $this->rootCategories = $params->get('front.root_categories');
        $this->sitePath = $params->get('back.site_path');
        $this->siteUrl = $params->get('back.site_url');
    }

    /**
     * @return array|mixed
     */
    public function getRootCategories()
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
}