<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\OrderClearEvent;
use App\Repository\Front\OrderSimpleFieldsRepository as OrderSimpleFieldsFrontRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearOrderSimpleFields implements EventSubscriberInterface
{
    /** @var OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository */
    protected $orderSimpleFieldsFrontRepository;

    /** @var ?bool $orderSimpleFieldsFrontTableExists */
    protected $orderSimpleFieldsFrontTableExists = null;

    /**
     * ClearOrdersSimpleFields constructor.
     * @param OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository
     */
    public function __construct(OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository)
    {
        $this->orderSimpleFieldsFrontRepository = $orderSimpleFieldsFrontRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            OrderClearEvent::class => 'action',
        ];
    }

    /**
     *
     */
    public function action(): void
    {
        if (null === $this->orderSimpleFieldsFrontTableExists) {
            $this->orderSimpleFieldsFrontTableExists = $this->orderSimpleFieldsFrontRepository->tableExists();
        }

        if (false === $this->orderSimpleFieldsFrontRepository->tableExists()) {
            return;
        }

        $this->orderSimpleFieldsFrontRepository->clear();
        $this->orderSimpleFieldsFrontRepository->resetAutoIncrements();
    }
}