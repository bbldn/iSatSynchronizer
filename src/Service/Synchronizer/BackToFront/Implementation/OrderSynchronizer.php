<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Front\OrderProduct as OrderProductFront;
use App\Entity\Order;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
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
use Psr\Log\LoggerInterface;

class OrderSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var CurrencyFrontRepository $currencyFrontRepository */
    protected $currencyFrontRepository;

    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /** @var CustomerFrontRepository $customerFrontRepository */
    protected $customerFrontRepository;

    /** @var OrderRepository $orderRepository */
    protected $orderRepository;

    /** @var OrderFrontRepository $orderFrontRepository */
    protected $orderFrontRepository;

    /** @var OrderProductFrontRepository $orderProductFrontRepository */
    protected $orderProductFrontRepository;

    /** @var OrderBackRepository $orderBackRepository */
    protected $orderBackRepository;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductDescriptionFrontRepository $productDescriptionFrontRepository */
    protected $productDescriptionFrontRepository;

    /** @var array $excludeCustomerIds */
    protected $excludeCustomerIds = [
        3233, 4835, 7436, 7439, 12012,
        12669, 12956, 13110, 14127,
        14128, 14129, 14466, 14665,
        15328, 16383, 0,
    ];

    /**
     * OrderSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param CurrencyFrontRepository $currencyFrontRepository
     * @param CustomerRepository $customerRepository
     * @param CustomerFrontRepository $customerFrontRepository
     * @param OrderRepository $orderRepository
     * @param OrderFrontRepository $orderFrontRepository
     * @param OrderProductFrontRepository $orderProductFrontRepository
     * @param OrderBackRepository $orderBackRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductDescriptionFrontRepository $productDescriptionFrontRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        LoggerInterface $logger,
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
        $this->logger = $logger;
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
     *
     */
    protected function clear(): void
    {
        $this->orderProductFrontRepository->clear();
        $this->orderFrontRepository->clear();
        $this->orderRepository->clear();

        $this->orderProductFrontRepository->resetAutoIncrements();
        $this->orderFrontRepository->resetAutoIncrements();
        $this->orderRepository->resetAutoIncrements();
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

        $orderFront->setInvoiceNo($this->storeFront->getDefaultInvoiceNo());
        $orderFront->setInvoicePrefix($this->storeFront->getInvoicePrefix());
        $orderFront->setStoreId($this->storeFront->getDefaultShopId());
        $orderFront->setStoreName($this->storeFront->getStoreName());
        $orderFront->setStoreUrl($this->storeFront->getSiteUrl());
        $orderFront->setCustomerId($customerFrontId);
        $orderFront->setCustomerGroupId($this->storeFront->getDefaultCustomerGroupId());
        $orderFront->setFirstName($fullName['firstName']);
        $orderFront->setLastName($fullName['lastName']);
        $orderFront->setEmail($mainOrderBack->getMail());
        $orderFront->setTelephone($mainOrderBack->getPhone());
        $orderFront->setFax(Filler::securityString(null));
        $orderFront->setCustomField($this->storeFront->getDefaultCustomField());
        $orderFront->setPaymentFirstName($fullName['firstName']);
        $orderFront->setPaymentLastName($fullName['lastName']);
        $orderFront->setPaymentCompany(Filler::securityString(null));
        $orderFront->setPaymentAddress1($address);
        $orderFront->setPaymentAddress2(Filler::securityString(null));
        $orderFront->setPaymentCity($mainOrderBack->getCity());
        $orderFront->setPaymentPostCode(Filler::securityString(null));
        $orderFront->setPaymentCountry($this->storeFront->getDefaultCountry());
        $orderFront->setPaymentCountryId($this->storeFront->getDefaultCountryId());
        $orderFront->setPaymentZone($mainOrderBack->getCity());
        $orderFront->setPaymentZoneId($zoneId);
        $orderFront->setPaymentAddressFormat(Filler::securityString(null));
        $orderFront->setPaymentCustomField($this->storeFront->getDefaultCustomField());
        $orderFront->setPaymentMethod($this->storeFront->getDefaultPaymentMethod());
        $orderFront->setPaymentCode($this->storeFront->getDefaultPaymentCode());
        $orderFront->setShippingFirstName($fullName['firstName']);
        $orderFront->setShippingLastName($fullName['lastName']);
        $orderFront->setShippingCompany(Filler::securityString(null));
        $orderFront->setShippingAddress1($address);
        $orderFront->setShippingAddress2(Filler::securityString(null));
        $orderFront->setShippingCity($mainOrderBack->getCity());
        $orderFront->setShippingPostCode(Filler::securityString(null));
        $orderFront->setShippingCountry($this->storeFront->getDefaultCountry());
        $orderFront->setShippingCountryId($this->storeFront->getDefaultCountryId());
        $orderFront->setShippingZone($mainOrderBack->getCity());
        $orderFront->setShippingZoneId($zoneId);
        $orderFront->setShippingAddressFormat(Filler::securityString(null));
        $orderFront->setShippingCustomField($this->storeFront->getDefaultCustomField());
        $orderFront->setShippingMethod($this->storeFront->getDefaultShippingMethod());
        $orderFront->setShippingCode($this->storeFront->getDefaultShippingCode());

        if (null === $mainOrderBack->getWhant()) {
            $comment = Filler::securityString(null);
        } else {
            $comment = $mainOrderBack->getWhant();
        }
        $orderFront->setComment($comment);
        $orderFront->setTotal(
            $this->orderBackRepository->getTotalPrice($mainOrderBack->getOrderNum()) * $mainOrderBack->getCurrencyValue()
        );
        $orderFront->setOrderStatusId(StoreFront::convertBackToFrontStatusOrder($mainOrderBack->getStatus()));
        $orderFront->setAffiliateId($this->storeFront->getDefaultAffiliateId());
        $orderFront->setCommission($this->storeFront->getDefaultCommission());
        $orderFront->setMarketingId($this->storeFront->getDefaultMarketingId());

        if (null === $orderFront->getTracking()) {
            $orderFront->setTracking(Filler::securityString(null));
        }

        $orderFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $orderFront->setCurrencyId($currency['id']);
        $orderFront->setCurrencyCode($currency['code']);
        $orderFront->setCurrencyValue($this->currencyFrontRepository->getCurrentCurrency($currency['id']));

        if (null === $orderFront->getIp()) {
            $orderFront->setIp(Filler::securityString(null));
        }

        if (null === $orderFront->getForwardedIp()) {
            $orderFront->setForwardedIp(Filler::securityString(null));
        }

        if (null === $orderFront->getUserAgent()) {
            $orderFront->setUserAgent(Filler::securityString(null));
        }

        if (null === $orderFront->getAcceptLanguage()) {
            $orderFront->setAcceptLanguage(Filler::securityString(null));
        }

        $date = new DateTime();
        $date->setTimestamp($mainOrderBack->getTime());
        $orderFront->setDateAdded($date);
        $orderFront->setDateModified($date);

        $this->orderFrontRepository->persistAndFlush($orderFront);

        $ordersBack = $this->orderBackRepository->findByOrderNum($mainOrderBack->getId());

        foreach ($ordersBack as $orderBack) {
            $product = $this->productRepository->findOneByBackId($orderBack->getProductId());

            if (null === $product) {
                $this->logger->error(
                    ExceptionFormatter::f("Product with for back id {$orderBack->getProductId()} not found")
                );

                return $orderFront;
            }

            $productFront = $this->productFrontRepository->find($product->getFrontId());

            if (null === $productFront) {
                $this->logger->error(
                    ExceptionFormatter::f("Product front with id: {$product->getFrontId()} not found")
                );

                return $orderFront;
            }

            $productDescriptionFront = $this->productDescriptionFrontRepository->find($product->getFrontId());

            if (null === $productDescriptionFront) {
                $message = "Product Description front with id: {$product->getFrontId()} not found";
                $this->logger->error(ExceptionFormatter::f($message));

                return $orderFront;
            }

            $total = $orderBack->getAmount() * $orderBack->getPrice();
            $orderProductFront = new OrderProductFront();
            $orderProductFront->setOrderId($orderFront->getOrderId());
            $orderProductFront->setProductId($product->getFrontId());
            $orderProductFront->setName(Store::encodingConvert($productDescriptionFront->getName()));
            $orderProductFront->setModel(Store::encodingConvert($productFront->getModel()));
            $orderProductFront->setQuantity($orderBack->getAmount());
            $orderProductFront->setPrice($orderBack->getPrice());
            $orderProductFront->setTotal($total);
            $orderProductFront->setTax($this->storeFront->getDefaultTax());
            $orderProductFront->setReward($this->storeFront->getDefaultReward());

            $this->orderProductFrontRepository->persistAndFlush($orderProductFront);
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

        $this->orderRepository->persistAndFlush($order);
    }
}