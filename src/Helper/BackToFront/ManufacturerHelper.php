<?php

namespace App\Helper\BackToFront;

use App\Contract\BackToFront\ManufacturerHelperInterface;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ManufacturerRepository as ManufacturerFrontRepository;

class ManufacturerHelper implements ManufacturerHelperInterface
{
    /** @var ManufacturerFrontRepository $manufacturerFrontRepository */
    protected $manufacturerFrontRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var array $cache */
    protected $cache = [];

    /**
     * ManufacturerSynchronizer constructor.
     * @param ManufacturerFrontRepository $manufacturerFrontRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        ManufacturerFrontRepository $manufacturerFrontRepository,
        StoreFront $storeFront
    )
    {
        $this->manufacturerFrontRepository = $manufacturerFrontRepository;
        $this->storeFront = $storeFront;
    }

    /**
     *
     */
    protected function loadCache(): void
    {
        if (count($this->cache) > 0) {
            return;
        }

        $manufacturers = $this->manufacturerFrontRepository->findAll();
        foreach ($manufacturers as $manufacturer) {
            $this->cache[$manufacturer->getManufacturerId()] = trim(mb_strtolower($manufacturer->getName()));
        }
    }

    /**
     * @param string $productName
     * @return int
     */
    public function getManufacturerId(string $productName): int
    {
        $this->loadCache();
        $productName = mb_strtolower($productName);

        foreach ($this->cache as $id => $name) {
            if (false !== mb_strpos($productName, $name)) {
                return $id;
            }
        }

        return $this->storeFront->getDefaultManufacturerId();
    }

    /**
     *
     */
    public function load(): void
    {
    }
}