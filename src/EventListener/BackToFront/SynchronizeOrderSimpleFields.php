<?php

namespace App\EventListener\BackToFront;

use App\Entity\Front\Order as OrderFront;
use App\Entity\Front\OrderSimpleFields as OrderSimpleFieldsFront;
use App\Event\BackToFront\OrderSynchronizedEvent;
use App\Exception\OrderBackNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Helper\ShippingConverter;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use App\Repository\Front\OrderSimpleFieldsRepository as OrderSimpleFieldsFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeOrderSimpleFields implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository */
    protected $orderSimpleFieldsFrontRepository;

    /** @var OrderFrontRepository $orderFrontRepository */
    protected $orderFrontRepository;

    /** @var OrderBackRepository $orderBackRepository */
    protected $orderBackRepository;

    /** @var ?bool $orderSimpleFieldsFrontTableExists */
    protected $orderSimpleFieldsFrontTableExists = null;

    /**
     * SynchronizeOrderSimpleFields constructor.
     * @param OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository
     * @param OrderFrontRepository $orderFrontRepository
     * @param OrderBackRepository $orderBackRepository
     */
    public function __construct(
        OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository,
        OrderFrontRepository $orderFrontRepository,
        OrderBackRepository $orderBackRepository
    )
    {
        $this->orderSimpleFieldsFrontRepository = $orderSimpleFieldsFrontRepository;
        $this->orderFrontRepository = $orderFrontRepository;
        $this->orderBackRepository = $orderBackRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            OrderSynchronizedEvent::class => 'action',
        ];
    }

    /**
     * @param OrderSynchronizedEvent $event
     */
    public function action(OrderSynchronizedEvent $event): void
    {
        try {
            $this->_action($event);
        } catch (OrderBackNotFoundException $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param OrderSynchronizedEvent $event
     * @throws OrderBackNotFoundException
     */
    protected function _action(OrderSynchronizedEvent $event): void
    {
        if (null === $this->orderSimpleFieldsFrontTableExists) {
            $this->orderSimpleFieldsFrontTableExists = $this->orderSimpleFieldsFrontRepository->tableExists();
        }

        if (false === $this->orderSimpleFieldsFrontRepository->tableExists()) {
            return;
        }

        $order = $event->getOrder();
        if (null === $order) {
            throw new OrderBackNotFoundException("Order not found");
        }

        $orderBack = $this->orderBackRepository->find($order->getBackId());
        if (null === $orderBack) {
            throw new OrderBackNotFoundException("Order Back with id: {$order->getBackId()} not found");
        }

        $shippingCode = ShippingConverter::backToFront($orderBack->getDelivery());
        if ('novaposhta.novaposhta' !== $shippingCode) {
            return;
        }

        $orderFront = $this->orderFrontRepository->find($order->getFrontId());
        if (null === $orderFront) {
            throw new OrderBackNotFoundException("Order Front with id: {$order->getFrontId()} not found");
        }

        $orderSimpleFieldsFront = $this->getOrderSimpleFieldsFront($orderFront);
        $orderSimpleFieldsFront->setOrderId($orderFront->getOrderId());
        $orderSimpleFieldsFront->setMetadata('oblast,gorod,otdelenie');
        $orderSimpleFieldsFront->setOblast($orderFront->getPaymentCountryId());
        $orderSimpleFieldsFront->setGorod($orderFront->getPaymentZoneId());
        $orderSimpleFieldsFront->setOtdelenie($orderBack->getWarehouse());

        $this->orderSimpleFieldsFrontRepository->persistAndFlush($orderSimpleFieldsFront);
    }

    /**
     * @param OrderFront $orderFront
     * @return OrderSimpleFieldsFront
     */
    protected function getOrderSimpleFieldsFront(OrderFront $orderFront): OrderSimpleFieldsFront
    {
        if (null === $orderFront->getOrderId()) {
            return new OrderSimpleFieldsFront();
        }

        $orderSimpleFields = $this->orderSimpleFieldsFrontRepository->find($orderFront->getOrderId());
        if (null === $orderSimpleFields) {
            return new OrderSimpleFieldsFront();
        }

        return $orderSimpleFields;
    }
}