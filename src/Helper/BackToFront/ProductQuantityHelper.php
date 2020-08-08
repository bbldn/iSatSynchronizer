<?php

namespace App\Helper\BackToFront;

use App\Entity\Product;
use App\Exception\AgsatCacheFormatException;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductFrontNotFoundException;
use App\Helper\AgsatProductsCacheForAvailability;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Back\CompetitorsProductsRepository as CompetitorsProductsBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use Psr\Log\LoggerInterface;

class ProductQuantityHelper
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var AgsatProductsCacheForAvailability $agsatProductsCacheForAvailability */
    protected $agsatProductsCacheForAvailability;

    /** @var CompetitorsProductsBackRepository $competitorsProductsBackRepository */
    protected $competitorsProductsBackRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * SynchronizeProductQuantity constructor.
     * @param LoggerInterface $logger
     * @param AgsatProductsCacheForAvailability $agsatProductsCacheForAvailability
     * @param CompetitorsProductsBackRepository $competitorsProductsBackRepository
     * @param ProductBackRepository $productBackRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        LoggerInterface $logger,
        AgsatProductsCacheForAvailability $agsatProductsCacheForAvailability,
        CompetitorsProductsBackRepository $competitorsProductsBackRepository,
        ProductBackRepository $productBackRepository,
        ProductFrontRepository $productFrontRepository,
        StoreFront $storeFront
    )
    {
        $this->logger = $logger;
        $this->agsatProductsCacheForAvailability = $agsatProductsCacheForAvailability;
        $this->competitorsProductsBackRepository = $competitorsProductsBackRepository;
        $this->productBackRepository = $productBackRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->storeFront = $storeFront;
    }

    /**
     * @param Product $product
     * @throws ProductBackNotFoundException
     * @throws ProductFrontNotFoundException
     */
    public function action(Product $product): void
    {
        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            $message = "Product Front with id: {$product->getFrontId()} not found";
            throw new ProductFrontNotFoundException($message);
        }

        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            $message = "Product Back with id: {$product->getBackId()} not found";
            throw new ProductBackNotFoundException($message);
        }

        if (true === $productBack->getNoBonus()) {
            $productFront->setQuantity(0);
            $productFront->setStockStatusId($this->storeFront->getDefaultProductNotAvailableStatusId());
            $this->productFrontRepository->persistAndFlush($productFront);

            return;
        }

        $productFront->setQuantity(99999);
        $productFront->setStockStatusId($this->storeFront->getDefaultProductAvailableStatusId());
        $this->productFrontRepository->persistAndFlush($productFront);

        //Проверка наличия у Agsat'а
//        $agsatStatus = $this->checkAgsatStatus($product);
//        if ($agsatStatus === $this->storeFront->getDefaultProductAvailableStatusId()) {
//            $productFront->setQuantity(99999);
//            $productFront->setStockStatusId($this->storeFront->getDefaultProductAvailableStatusId());
//            $this->productFrontRepository->persistAndFlush($productFront);
//
//            return;
//        }

        if ($productBack->getInStock() > 0) {
            $productFront->setQuantity(99999);
            $productFront->setStockStatusId($this->storeFront->getDefaultProductAvailableStatusId());
        } else {
            $productFront->setQuantity(0);
            $productFront->setStockStatusId($this->storeFront->getDefaultProductNotAvailableStatusId());
        }

        $this->productFrontRepository->persistAndFlush($productFront);
    }

    /**
     * @param Product $product
     * @return int
     * @throws AgsatCacheFormatException
     */
    protected function checkAgsatStatus(Product $product): int
    {
        $competitorsProductsFront = $this->competitorsProductsBackRepository->findOneByCompetitorIdAndProductId(
            3,
            $product->getBackId()
        );

        if (null === $competitorsProductsFront) {
            return $this->storeFront->getDefaultProductNotAvailableStatusId();
        }

        $url = trim($competitorsProductsFront->getUrl());
        if (0 === mb_strlen($url)) {
            return $this->storeFront->getDefaultProductNotAvailableStatusId();
        }

        $url = $this->normalizeUrl($url);

        $this->agsatProductsCacheForAvailability->load();

        $cache = $this->agsatProductsCacheForAvailability->getCache();
        if (true === key_exists($url, $cache)) {
            return $this->storeFront->getDefaultProductAvailableStatusId();
        }

        return $this->storeFront->getDefaultProductNotAvailableStatusId();
    }

    /**
     * @param string $url
     * @return string
     */
    protected function normalizeUrl(string $url): string
    {
        $url = preg_replace('/^https?:\/\/www\.agsat\.com\.ua/', '', $url);

        return rtrim($url, '/');
    }
}