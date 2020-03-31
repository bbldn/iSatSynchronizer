<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Front\OrderProduct as OrderProductFront;
use App\Entity\Order;
use App\Exception\OrderBackNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Fillers\Filler;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\CurrencyRepository as CurrencyFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use App\Repository\Front\OrderProductRepository as OrderProductFrontRepository;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use DateTime;

class OrderSynchronizer
{
    protected $storeFront;
    protected $currencyFrontRepository;
    protected $customerRepository;
    protected $customerFrontRepository;
    protected $orderRepository;
    protected $orderFrontRepository;
    protected $orderProductFrontRepository;
    protected $orderBackRepository;
    protected $productRepository;
    protected $productFrontRepository;
    protected $productDescriptionFrontRepository;

    protected $excludeCustomerIds = [
        3233, 4835, 7436, 7439, 12012,
        12669, 12956, 13110, 14127,
        14128, 14129, 14466, 14665,
        15328, 16383, 0,
    ];

    public function __construct(
        StoreFront $storeFront,
        CurrencyFrontRepository $currencyFrontRepository,
        CustomerRepository $customerRepository,
        CustomerFrontRepository $customerFrontRepository,
        OrderRepository $orderRepository,
        OrderFrontRepository $orderFrontRepository,
        OrderProductFrontRepository $orderProductFrontRepository,
        OrderBackRepository $orderBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductDescriptionFrontRepository $productDescriptionFrontRepository,
        ProductRepository $productRepository
    )
    {
        $this->storeFront = $storeFront;
        $this->currencyFrontRepository = $currencyFrontRepository;
        $this->customerRepository = $customerRepository;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->orderRepository = $orderRepository;
        $this->orderFrontRepository = $orderFrontRepository;
        $this->orderProductFrontRepository = $orderProductFrontRepository;
        $this->orderBackRepository = $orderBackRepository;
        $this->productRepository = $productRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productDescriptionFrontRepository = $productDescriptionFrontRepository;
    }

    /**
     * @param int $id
     * @throws OrderBackNotFoundException
     */
    public function synchronizeOne(int $id)
    {
        $orderBack = $this->orderBackRepository->find($id);
        if (null === $orderBack) {
            throw new OrderBackNotFoundException();
        }

        $this->synchronizeOrder($orderBack);
    }

    /**
     *
     */
    public function synchronizeAll()
    {
        $ordersBack = $this->orderBackRepository->findWithoutIds($this->excludeCustomerIds);
        foreach ($ordersBack as $orderBack) {
            $this->synchronizeOrder($orderBack);
        }
    }

    /**
     * @param OrderBack $orderBack
     */
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
     * @return OrderFront
     */
    protected function updateOrderFrontFromOrderBack(OrderFront $orderFront, OrderBack $mainOrderBack): OrderFront
    {
        $customer = $this->customerRepository->findOneByBackId($mainOrderBack->getClientId());
        $customerFrontId = 0;

        if (null !== $customer) {
            $customerFront = $this->customerFrontRepository->find($customer->getFrontId());
            if (null !== $customerFront) {
                $customerFrontId = $customerFront->getCustomerId();
            }
        }

        $fullName = StoreBack::parseFirstLastName($mainOrderBack->getFio());
        $address = $mainOrderBack->getStreet() . ' ' . $mainOrderBack->getHouse();
        $currency = Store::convertFrontToBackCurrency($mainOrderBack->getCurrencyName());
        $zoneId = 3490;

        $orderFront->fill(
            $this->storeFront->getDefaultInvoiceNo(),
            $this->storeFront->getInvoicePrefix(),
            $this->storeFront->getDefaultShopId(),
            $this->storeFront->getStoreName(),
            $this->storeFront->getSiteUrl(),
            $customerFrontId,
            $this->storeFront->getDefaultCustomerGroupId(),
            $fullName['firstName'],
            $fullName['lastName'],
            $mainOrderBack->getMail(),
            $mainOrderBack->getPhone(),
            Filler::securityString(null),
            $this->storeFront->getDefaultCustomField(),
            $fullName['firstName'],
            $fullName['lastName'],
            Filler::securityString(null),
            $address,
            Filler::securityString(null),
            $mainOrderBack->getCity(),
            Filler::securityString(null),
            $this->storeFront->getDefaultCountry(),
            $this->storeFront->getDefaultCountryId(),
            $mainOrderBack->getCity(),
            $zoneId,
            Filler::securityString(null),
            $this->storeFront->getDefaultCustomField(),
            $this->storeFront->getDefaultPaymentMethod(),
            $this->storeFront->getDefaultPaymentCode(),
            $fullName['firstName'],
            $fullName['lastName'],
            Filler::securityString(null),
            $address,
            Filler::securityString(null),
            $mainOrderBack->getCity(),
            Filler::securityString(null),
            $this->storeFront->getDefaultCountry(),
            $this->storeFront->getDefaultCountryId(),
            $mainOrderBack->getCity(),
            $zoneId,
            Filler::securityString(null),
            $this->storeFront->getDefaultCustomField(),
            $this->storeFront->getDefaultShippingMethod(),
            $this->storeFront->getDefaultShippingCode(),
            Filler::securityString(null),
            $this->orderBackRepository->getTotalPrice($mainOrderBack->getOrderNum()) * $mainOrderBack->getCurrencyValue(),
            StoreFront::convertBackToFrontStatusOrder($mainOrderBack->getStatus()),
            $this->storeFront->getDefaultAffiliateId(),
            $this->storeFront->getDefaultCommission(),
            $this->storeFront->getDefaultMarketingId(),
            Filler::securityString(null),
            $this->storeFront->getDefaultLanguageId(),
            $currency['id'],
            $currency['code'],
            $this->currencyFrontRepository->getCurrentCurrency($currency['id']),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null)
        );

        $dateAdded = new DateTime();
        $dateAdded->setTimestamp($mainOrderBack->getTime());
        $orderFront->setDateAdded($dateAdded);

        $this->orderFrontRepository->saveAndFlush($orderFront);

        $ordersBack = $this->orderBackRepository->findByOrderNum($mainOrderBack->getId());

        foreach ($ordersBack as $orderBack) {
            $product = $this->productRepository->findOneByBackId($orderBack->getProductId());

            if (null === $product) {
                //@TODO Notify
                return $orderFront;
            }

            $productFront = $this->productFrontRepository->find($product->getFrontId());

            if (null === $productFront) {
                //@TODO Notify
                return $orderFront;
            }

            $productDescriptionFront = $this->productDescriptionFrontRepository->find($product->getFrontId());

            if (null === $productDescriptionFront) {
                //@TODO Notify
                return $orderFront;
            }


            $total = $orderBack->getAmount() * $orderBack->getPrice();
            $orderProductFront = new OrderProductFront();
            $orderProductFront->fill(
                $orderFront->getOrderId(),
                $product->getFrontId(),
                Store::encodingConvert($productDescriptionFront->getName()),
                Store::encodingConvert($productFront->getModel()),
                $orderBack->getAmount(),
                $orderBack->getPrice(),
                $total,
                $this->storeFront->getDefaultTax(),
                $this->storeFront->getDefaultReward()
            );
            $this->orderProductFrontRepository->saveAndFlush($orderProductFront);
        }

        return $orderFront;
    }

    /**
     * @param Order|null $order
     * @return OrderFront
     */
    protected function getOrderFrontFromOrder(?Order $order): OrderFront
    {
        if (null === $order) {
            return new OrderFront();
        }

        $orderFront = $this->orderFrontRepository->find($order->getFrontId());

        if (null === $orderFront) {
            return new OrderFront();
        }

        return $orderFront;
    }

    /**
     * @param Order|null $order
     * @param int $backId
     * @param int $frontId
     */
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