<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Service\Synchronizer\BackToFront\ProductImageSynchronizer;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductImage implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductImageSynchronizer $productImageSynchronizer */
    protected $productImageSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * SynchronizeProductImage constructor.
     * @param LoggerInterface $logger
     * @param ProductBackRepository $productBackRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductImageSynchronizer $productImageSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        ProductBackRepository $productBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductImageSynchronizer $productImageSynchronizer
    )
    {
        $this->logger = $logger;
        $this->productBackRepository = $productBackRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productImageSynchronizer = $productImageSynchronizer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductSynchronizedEvent::class => 'action',
        ];
    }

    /**
     * @param ProductSynchronizedEvent $event
     */
    public function action(ProductSynchronizedEvent $event): void
    {
        if (false === $event->isSynchronizeImage()) {
            return;
        }

        if (false === $this->synchronizerLoaded) {
            $this->productImageSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();

        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            $message = "Product Back with id: {$product->getBackId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            $message = "Product Front with id: {$product->getFrontId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $this->productImageSynchronizer->synchronizeImage($productBack, $productFront);
    }
}