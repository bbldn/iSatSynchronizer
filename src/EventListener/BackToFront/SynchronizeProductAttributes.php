<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductAttributeSynchronizerInterface;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Throwable;

class SynchronizeProductAttributes implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductAttributeSynchronizerInterface $productAttributeSynchronizer */
    protected $productAttributeSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * SynchronizeProductAttributes constructor.
     * @param LoggerInterface $logger
     * @param ProductBackRepository $productBackRepository
     * @param ProductAttributeSynchronizerInterface $productAttributeSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        ProductBackRepository $productBackRepository,
        ProductAttributeSynchronizerInterface $productAttributeSynchronizer
    )
    {
        $this->logger = $logger;
        $this->productBackRepository = $productBackRepository;
        $this->productAttributeSynchronizer = $productAttributeSynchronizer;
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
        try {
            $this->_action($event);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param ProductSynchronizedEvent $event
     * @throws ProductBackNotFoundException
     * @throws ProductNotFoundException
     */
    protected function _action(ProductSynchronizedEvent $event): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productAttributeSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();
        if (null === $product) {
            throw new ProductNotFoundException("Product not found");
        }

        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            throw new ProductBackNotFoundException("Product back with id {$product->getBackId()} not found");
        }

        $this->productAttributeSynchronizer->synchronizeAttributes($productBack, $product->getFrontId());
    }
}