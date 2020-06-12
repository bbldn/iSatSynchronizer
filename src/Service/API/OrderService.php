<?php

namespace App\Service\API;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Exception\OrderBackNotFoundException;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\Back\ShippingMethodRepository as ShippingMethodBackRepository;
use App\Service\Service;
use App\Repository\Back\PaymentTypeRepository as PaymentMethodBackRepository;

class OrderService extends Service
{
    /** @var OrderBackRepository $orderBackRepository */
    protected $orderBackRepository;

    /** @var ShippingMethodBackRepository $shippingMethodBackRepository */
    protected $shippingMethodBackRepository;

    /** @var PaymentMethodBackRepository $paymentMethodBackRepository */
    protected $paymentMethodBackRepository;

    /**
     * OrderService constructor.
     * @param OrderBackRepository $orderBackRepository
     * @param ShippingMethodBackRepository $shippingMethodBackRepository
     * @param PaymentMethodBackRepository $paymentMethodBackRepository
     */
    public function __construct(
        OrderBackRepository $orderBackRepository,
        ShippingMethodBackRepository $shippingMethodBackRepository,
        PaymentMethodBackRepository $paymentMethodBackRepository
    )
    {
        $this->orderBackRepository = $orderBackRepository;
        $this->shippingMethodBackRepository = $shippingMethodBackRepository;
        $this->paymentMethodBackRepository = $paymentMethodBackRepository;
    }

    /**
     * @param int $id
     * @return array
     * @throws OrderBackNotFoundException
     */
    public function getOrderInformation(int $id): array
    {
        $ordersBack = $this->orderBackRepository->findByOrderNum($id);
        if (0 === count($ordersBack)) {
            throw new OrderBackNotFoundException('Order not found');
        }

        $orderBack = $ordersBack[0];

        $data = [
            'id' => $orderBack->getOrderNum(),
            'type' => $orderBack->getType(),
            'FIO' => $orderBack->getFio(),
            'phone' => $orderBack->getPhone(),
            'mail' => $orderBack->getMail(),
            'region' => $orderBack->getRegion(),
            'city' => $orderBack->getCity(),
            'street' => $orderBack->getStreet(),
            'house' => $orderBack->getHouse(),
            'warehouse' => $orderBack->getWarehouse(),
            'delivery' => $this->getDeliveryName($orderBack->getDelivery()),
            'payment' => $this->getPaymentName($orderBack->getPayment()),
            'comment' => $orderBack->getComments(),
            'products' => $this->getProducts($ordersBack),
        ];

        return $data;
    }

    /**
     * @param OrderBack[] $orders
     * @return array
     */
    protected function getProducts(array $orders): array
    {
        $data = [];

        foreach ($orders as $key => $order) {
            $data[] = [
                'number' => $key + 1,
                'name' => $order->getProductName(),
                'price' => round($order->getPrice(), 2),
                'amount' => $order->getAmount(),
                'currency_name' => $order->getCurrencyName(),
                'rate' => $order->getCurrencyValue(),
            ];
        }


        return $data;
    }

    /**
     * @param int $id
     * @return string
     */
    protected function getDeliveryName(int $id): string
    {
        $shippingMethod = $this->shippingMethodBackRepository->find($id);
        if (null !== $shippingMethod) {
            return trim($shippingMethod->getName());
        }

        return 'Неизвестно';
    }

    /**
     * @param int $id
     * @return string
     */
    protected function getPaymentName(int $id): string
    {
        $paymentMethod = $this->paymentMethodBackRepository->find($id);
        if (null !== $paymentMethod) {
            return trim($paymentMethod->getName());
        }

        return 'Неизвестно';
    }
}