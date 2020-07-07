<?php

namespace App\EventListener\FrontToBack;

use App\Event\FrontToBack\NewOrderEvent;
use App\Event\FrontToBack\UpdateOrderEvent;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SetOrderBackToOrderFront implements EventSubscriberInterface
{
    /** @var OrderFrontRepository $orderFrontRepository */
    protected $orderFrontRepository;

    /**
     * SetOrderBackToOrderFront constructor.
     * @param OrderFrontRepository $orderFrontRepository
     */
    public function __construct(OrderFrontRepository $orderFrontRepository)
    {
        $this->orderFrontRepository = $orderFrontRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            UpdateOrderEvent::class => 'action',
        ];
    }

    /**
     * @param UpdateOrderEvent $event
     */
    public function action(UpdateOrderEvent $event): void
    {
        $order = $event->getOrder();
        $orderFront = $this->orderFrontRepository->find($order->getFrontId());
        if (null === $orderFront) {
            return;
        }

        $orderFront->setFax((string)$order->getBackId());
        $this->orderFrontRepository->persistAndFlush($orderFront);
    }
}