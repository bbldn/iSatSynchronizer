<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Order;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use App\Repository\OrderRepository;

class OrderSynchronizer
{
    protected $orderRepository;
    protected $orderFrontRepository;
    protected $orderBackRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderFrontRepository $orderFrontRepository,
        OrderBackRepository $orderBackRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderFrontRepository = $orderFrontRepository;
        $this->orderBackRepository = $orderBackRepository;
    }

    protected function synchronizeOrder(OrderBack $orderBack): void
    {
        $order = $this->orderRepository->findOneByBackId($orderBack->getId());
        $orderFront = $this->getOrderFrontFromOrder($order);
        $this->updateOrderFrontFromOrderBack($orderFront, $orderBack);
        $this->createOrUpdateOrder($order, $orderBack->getId(), $orderFront->getOrderId());
    }

    /**
     * @param OrderFront $orderFront
     * @param OrderBack $mainOrderBack
     * @return OrderBack
     */
    protected function updateOrderFrontFromOrderBack(OrderFront $orderFront, OrderBack $mainOrderBack): OrderBack
    {
        $ordersBack = $this->orderBackRepository->findByOrderNum($mainOrderBack->getId());

        foreach ($ordersBack as $orderBack) {

        }
    }

    protected function getOrderFrontFromOrder(?Order $order): OrderFront
    {
        if (null === $order) {
            return new OrderFront();
        }

        $orderBack = $this->orderFrontRepository->find($order->getFrontId());

        if (null === $orderBack) {
            return new OrderFront();
        }

        return $orderBack;
    }

    protected function createOrUpdateOrder(?Order $order, int $backId, int $frontId): void
    {
        if (null === $order) {
            $order = new Order();
        }
        $order->setBackId($backId);
        $order->setFrontId($frontId);
        $this->orderRepository->saveAndFlush($order);
    }
}