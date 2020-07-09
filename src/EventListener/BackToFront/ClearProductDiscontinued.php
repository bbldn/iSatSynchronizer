<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductsClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Repository\Front\ProductDiscontinuedRepository as ProductDiscontinuedFrontRepository;

class ClearProductDiscontinued implements EventSubscriberInterface
{
    /** @var ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository */
    protected $productDiscontinuedFrontRepository;

    /** @var ?bool $productDiscontinuedTableExists */
    protected $productDiscontinuedTableExists = null;

    /**
     * ClearProductDiscontinued constructor.
     * @param ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
     */
    public function __construct(ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository)
    {
        $this->productDiscontinuedFrontRepository = $productDiscontinuedFrontRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductsClearEvent::class => 'action'
        ];
    }

    /**
     *
     */
    public function action(): void
    {
        if (null === $this->productDiscontinuedTableExists) {
            $this->productDiscontinuedTableExists = $this->productDiscontinuedFrontRepository->tableExists();
        }

        if (true === $this->productDiscontinuedTableExists) {
            $this->productDiscontinuedFrontRepository->removeAll();
            $this->productDiscontinuedFrontRepository->resetAutoIncrements();
        }
    }
}