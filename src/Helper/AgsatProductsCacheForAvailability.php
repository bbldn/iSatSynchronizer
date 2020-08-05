<?php

namespace App\Helper;

use App\Contract\AgsatProductsCacheLoaderInterface;
use App\Exception\AgsatCacheFormatException;

class AgsatProductsCacheForAvailability
{
    /** @var AgsatProductsCacheLoaderInterface $agsatProductsCacheLoader */
    protected $agsatProductsCacheLoader;

    /** @var array $cache */
    protected $cache = [];

    /**
     * AgsatProductsCache constructor.
     * @param AgsatProductsCacheLoaderInterface $agsatProductsCacheLoader
     */
    public function __construct(AgsatProductsCacheLoaderInterface $agsatProductsCacheLoader)
    {
        $this->agsatProductsCacheLoader = $agsatProductsCacheLoader;
    }

    /**
     * @throws AgsatCacheFormatException
     */
    public function load(): void
    {
        if (count($this->cache) > 0) {
            return;
        }

        $cache = $this->agsatProductsCacheLoader->load();

        foreach ($cache as $item) {
            $this->validateItem($item);
            $this->cache[$this->normalizeUrl($item['frontend_url'])] = 1;
        }
    }

    /**
     * @return array
     */
    public function getCache(): array
    {
        return $this->cache;
    }

    /**
     * @param array $cache
     * @return AgsatProductsCacheForAvailability
     */
    public function setCache(array $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @param array $item
     * @throws AgsatCacheFormatException
     */
    protected function validateItem(array $item): void
    {
        if (false === key_exists('frontend_url', $item)) {
            throw new AgsatCacheFormatException("field `frontend_url` not found");
        }
    }

    /**
     * @param string $url
     * @return string
     */
    protected function normalizeUrl(string $url): string
    {
        return rtrim(trim($url), '/');
    }
}