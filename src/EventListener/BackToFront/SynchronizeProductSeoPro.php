<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductSeoUrlSynchronizerInterface;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductFrontNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Throwable;

class SynchronizeProductSeoPro implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductSeoUrlSynchronizerInterface $productSeoUrlBackToFrontSynchronizer */
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
     * @param ProductSeoUrlSynchronizerInterface $productSeoUrlBackToFrontSynchronizer
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductBackRepository $productBackRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ProductSeoUrlSynchronizerInterface $productSeoUrlBackToFrontSynchronizer,
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

    public function action(ProductSynchronizedEvent $event): void
    {
        try {
            $this->_action($event);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param ProductSynchronizedEvent $event
     * @throws ProductBackNotFoundException
     * @throws ProductFrontNotFoundException
     * @throws ProductNotFoundException
     */
    public function _action(ProductSynchronizedEvent $event): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productSeoUrlBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();
        if (null === $product) {
            throw new ProductNotFoundException("Product not found");
        }

        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            throw new ProductBackNotFoundException("ProductBack with id {$product->getBackId()} not found");
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            throw new ProductFrontNotFoundException("ProductFront with id {$product->getFrontId()} not found");
        }

        $this->productSeoUrlBackToFrontSynchronizer->synchronizeByProductBackAndProductFront(
            $productBack,
            $productFront
        );
    }
}