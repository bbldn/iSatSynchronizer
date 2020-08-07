<?php

namespace App\Service\API;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Exception\OrderBackNotFoundException;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\Back\PaymentTypeRepository as PaymentMethodBackRepository;
use App\Repository\Back\ShippingMethodRepository as ShippingMethodBackRepository;

class OrderService extends ApiService
{
    /** @var OrderBackRepository $orderBackRepository */
    protected $orderBackRepository;

    /** @var ShippingMethodBackRepository $shippingMethodBackRepository */
    protected $shippingMethodBackRepository;

    /** @var PaymentMethodBackRepository $paymentMethodBackRepository */
    protected $paymentMethodBackRepository;

    /** @var CustomerBackRepository $customerBackRepository */
    protected $customerBackRepository;

    /**
     * OrderService constructor.
     * @param OrderBackRepository $orderBackRepository
     * @param ShippingMethodBackRepository $shippingMethodBackRepository
     * @param PaymentMethodBackRepository $paymentMethodBackRepository
     * @param CustomerBackRepository $customerBackRepository
     */
    public function __construct(
        OrderBackRepository $orderBackRepository,
        ShippingMethodBackRepository $shippingMethodBackRepository,
        PaymentMethodBackRepository $paymentMethodBackRepository,
        CustomerBackRepository $customerBackRepository
    )
    {
        $this->orderBackRepository = $orderBackRepository;
        $this->shippingMethodBackRepository = $shippingMethodBackRepository;
        $this->paymentMethodBackRepository = $paymentMethodBackRepository;
        $this->customerBackRepository = $customerBackRepository;
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
        $customer = null;

        $phone = trim($orderBack->getPhone());
        if (mb_strlen($phone) === 0 && $orderBack->getClientId() > 1) {
            $customer = $this->customerBackRepository->find($orderBack->getClientId());
            if (null !== $customer) {
                $phone = $customer->getPhone();
            }
        }

        $mail = trim($orderBack->getMail());
        if (mb_strlen($mail) === 0 && $orderBack->getClientId() > 1) {
            if (null === $customer) {
                $customer = $this->customerBackRepository->find($orderBack->getClientId());
            }

            if (null !== $customer) {
                $mail = $customer->getMail();
            }
        }

        $data = [
            'id' => $orderBack->getOrderNum(),
            'type' => $orderBack->getType(),
            'FIO' => $orderBack->getFio(),
            'phone' => $phone,
            'mail' => $mail,
            'region' => $orderBack->getRegion(),
            'city' => $orderBack->getCity(),
            'street' => $orderBack->getStreet(),
            'house' => $orderBack->getHouse(),
            'warehouse' => $orderBack->getWarehouse(),
            'delivery' => $this->getDeliveryName($orderBack->getDelivery()),
            'payment' => $this->getPaymentName($orderBack->getPayment()),
            'comment' => $orderBack->getComments(),
            'total' => $this->getOrderTotal($ordersBack) . ' ' . $orderBack->getCurrencyName(),
            'balance' => $this->customerBackRepository->getBalanceByCustomerId($orderBack->getClientId()) . '$',
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
            $price = round($order->getPrice() * $order->getCurrencyValue(), 2);
            $data[] = [
                'number' => $key + 1,
                'name' => $order->getProductName(),
                'price' => "{$price} {$order->getCurrencyName()}",
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

    /**
     * @param array $orders
     * @return float
     */
    protected function getOrderTotal(array $orders): float
    {
        $total = 0;
        foreach ($orders as $key => $order) {
            $total += round($order->getPrice() * $order->getCurrencyValue(), 2);
        }

        return $total;
    }
}