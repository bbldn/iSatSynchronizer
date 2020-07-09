<?php

namespace App\EventListener\BackToFront;

use App\Entity\Front\ProductDiscontinued as ProductDiscontinuedFront;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\ProductDiscontinuedRepository as ProductDiscontinuedFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductDiscontinued implements EventSubscriberInterface
{
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
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductBackRepository $productBackRepository
     * @param ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
     */
    public function __construct(
        ProductFrontRepository $productFrontRepository,
        ProductBackRepository $productBackRepository,
        ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
    )
    {
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
        if (null === $this->productDiscontinuedTableExists) {
            $this->productDiscontinuedTableExists = $this->productDiscontinuedFrontRepository->tableExists();
        }

        if (false === $this->productDiscontinuedTableExists) {
            return;
        }

        $product = $event->getProduct();

        $productBack = $this->productBackRepository->find($product->getBackId());
        if (null === $productBack) {
            //@TODO Notify
            return;
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            //@TODO Notify
            return;
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