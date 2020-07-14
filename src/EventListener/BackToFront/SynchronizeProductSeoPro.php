<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductSeoUrlSynchronizerContract;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductSeoPro implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductSeoUrlSynchronizerContract $productSeoUrlBackToFrontSynchronizer */
    protected $productSeoUrlBackToFrontSynchronizer;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * SynchronizeProductSeoPro constructor.
     * @param LoggerInterface $logger
     * @param ProductSeoUrlSynchronizerContract $productSeoUrlBackToFrontSynchronizer
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductBackRepository $productBackRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ProductSeoUrlSynchronizerContract $productSeoUrlBackToFrontSynchronizer,
        ProductFrontRepository $productFrontRepository,
        ProductBackRepository $productBackRepository
    )
    {
        $this->logger = $logger;
        $this->productSeoUrlBackToFrontSynchronizer = $productSeoUrlBackToFrontSynchronizer;
        $this->productFrontRepository = $productFrontRepository;
        $this->productBackRepository = $productBackRepository;
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
        if (false === $this->synchronizerLoaded) {
            $this->productSeoUrlBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();
        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            $message = "ProductBack with id {$product->getBackId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            $message = "ProductFront with id {$product->getFrontId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $this->productSeoUrlBackToFrontSynchronizer->synchronizeByProductBackAndProductFront(
            $productBack,
            $productFront
        );
    }
}