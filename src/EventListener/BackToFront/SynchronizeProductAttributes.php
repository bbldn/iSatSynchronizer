<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductAttributeSynchronizerInterface;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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
        if (false === $this->synchronizerLoaded) {
            $this->productAttributeSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();
        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            $message = "Product back with id {$product->getBackId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $this->productAttributeSynchronizer->synchronizeAttributes($productBack, $product->getFrontId());
    }
}