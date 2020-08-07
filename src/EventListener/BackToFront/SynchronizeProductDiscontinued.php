<?php

namespace App\EventListener\BackToFront;

use App\Entity\Front\ProductDiscontinued as ProductDiscontinuedFront;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\ProductDiscontinuedRepository as ProductDiscontinuedFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Throwable;

class SynchronizeProductDiscontinued implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository */
    protected $productDiscontinuedFrontRepository;

    /** @var bool|null $productDiscontinuedTableExists */
    protected $productDiscontinuedTableExists = null;

    /**
     * SynchronizeProductDiscontinued constructor.
     * @param LoggerInterface $logger
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductBackRepository $productBackRepository
     * @param ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ProductFrontRepository $productFrontRepository,
        ProductBackRepository $productBackRepository,
        ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
    )
    {
        $this->logger = $logger;
        $this->productFrontRepository = $productFrontRepository;
        $this->productBackRepository = $productBackRepository;
        $this->productDiscontinuedFrontRepository = $productDiscontinuedFrontRepository;
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
        if (null === $this->productDiscontinuedTableExists) {
            $this->productDiscontinuedTableExists = $this->productDiscontinuedFrontRepository->tableExists();
        }

        if (false === $this->productDiscontinuedTableExists) {
            return;
        }

        $product = $event->getProduct();
        if (null === $product) {
            throw new ProductNotFoundException("Product not found");
        }

        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            throw new ProductBackNotFoundException("ProductBack with id: {$product->getBackId()} not found");
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            throw new ProductBackNotFoundException("ProductFront with id: {$product->getFrontId()} not found");
        }

        if (true === $productBack->getDiscontinued()) {
            $exists = $this->productDiscontinuedFrontRepository->exists($productFront->getProductId());
            if (false === $exists) {
                $productFrontDiscontinued = new ProductDiscontinuedFront();
                $productFrontDiscontinued->setProductId($productFront->getProductId());

                $this->productDiscontinuedFrontRepository->persistAndFlush($productFrontDiscontinued);
            }
        } else {
            $this->productDiscontinuedFrontRepository->removeById($productFront->getProductId());
        }
    }
}