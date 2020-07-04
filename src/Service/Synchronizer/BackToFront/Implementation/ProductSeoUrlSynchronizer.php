<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\SeoUrl as SeoUrlFront;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\ProductRepository as ProductRepository;
use App\Repository\Front\SeoUrlRepository as SeoUrlFrontRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use Psr\Log\LoggerInterface;

class ProductSeoUrlSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var SeoUrlFrontRepository $seoUrlFrontRepository */
    protected $seoUrlFrontRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var bool $seoUrlTableExists */
    protected $seoUrlTableExists = false;

    /**
     * ProductSeoUrlSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param ProductBackRepository $productBackRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductRepository $productRepository
     * @param SeoUrlFrontRepository $seoUrlFrontRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        LoggerInterface $logger,
        ProductBackRepository $productBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductRepository $productRepository,
        SeoUrlFrontRepository $seoUrlFrontRepository,
        StoreFront $storeFront
    )
    {
        $this->logger = $logger;
        $this->productBackRepository = $productBackRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productRepository = $productRepository;
        $this->seoUrlFrontRepository = $seoUrlFrontRepository;
        $this->storeFront = $storeFront;
    }

    /**
     *
     */
    protected function _load()
    {
        $this->seoUrlTableExists = $this->seoUrlFrontRepository->tableExists();
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    protected function synchronizeByProductBackAndProductFront(
        ProductBack $productBack,
        ProductFront $productFront
    ): void
    {
        $seoUrl = $this->seoUrlFrontRepository->findOneByQueryAndLanguageId(
            "product_id={$productFront->getProductId()}",
            $this->storeFront->getDefaultLanguageId()
        );

        if (null === $seoUrl) {
            $seoUrl = new SeoUrlFront();
        }

        $seoUrl->setStoreId($this->storeFront->getDefaultStoreId());
        $seoUrl->setLanguageId($this->storeFront->getDefaultLanguageId());
        $seoUrl->setQuery("product_id={$productFront->getProductId()}");

        $slug = Filler::trim($productBack->getSlug());

        if (mb_strlen($slug) > 0) {
            $slugs = explode('/', $slug);
            if (count($slugs) > 1) {
                $seoUrl->setKeyword($slugs[1]);
            } else {
                $seoUrl->setKeyword($slug);
            }
        } else {
            $seoUrl->setKeyword(
                StoreFront::generateURL($productBack->getProductId(), Store::encodingConvert($productBack->getName()))
            );
        }

        $this->seoUrlFrontRepository->persistAndFlush($seoUrl);
    }

    /**
     *
     */
    protected function synchronizeAll(): void
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $this->synchronizeByProductBack($productBack);
        }
    }

    /**
     * @param string $ids
     */
    protected function synchronizeByIds(string $ids): void
    {
        $productsBack = $this->productBackRepository->findByIds($ids);
        foreach ($productsBack as $productBack) {
            $this->synchronizeByProductBack($productBack);
        }
    }

    /**
     * @param ProductBack $productBack
     */
    protected function synchronizeByProductBack(ProductBack $productBack): void
    {
        $product = $this->productRepository->findOneByBackId($productBack->getProductId());
        if (null === $product) {
            $message = "Product Back with id: {$productBack->getProductId()} not synchronized";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            $message = "Product Front with id: {$product->getFrontId()} not synchronized";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $this->synchronizeByProductBackAndProductFront($productBack, $productFront);
    }

    /**
     *
     */
    protected function clearRemove(): void
    {
        $this->seoUrlFrontRepository->removeAllByQuery('product_id');
    }
}