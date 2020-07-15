<?php

namespace App\EventListener\FrontToBack;

use App\Event\FrontToBack\UpdateOrderEvent;
use App\Helper\ExceptionFormatter;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SetOrderBackToOrderFront implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var OrderFrontRepository $orderFrontRepository */
    protected $orderFrontRepository;

    /**
     * SetOrderBackToOrderFront constructor.
     * @param LoggerInterface $logger
     * @param OrderFrontRepository $orderFrontRepository
     */
    public function __construct(LoggerInterface $logger, OrderFrontRepository $orderFrontRepository)
    {
        $this->logger = $logger;
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
            $message = "Order Front with id {$order->getFrontId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $orderFront->setFax((string)$order->getBackId());
        $this->orderFrontRepository->persistAndFlush($orderFront);
    }
}