<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Front\OrderHistory as OrderHistoryFront;
use App\Entity\Front\OrderProduct as OrderProductFront;
use App\Entity\Order;
use App\Event\BackToFront\OrderSynchronizedEvent;
use App\Helper\Back\Store as StoreBack;
use App\Helper\BackToFront\OrderSynchronizerHelper;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\PaymentConverter;
use App\Helper\ShippingConverter;
use App\Helper\Store;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\Back\PaymentTypeRepository;
use App\Repository\Back\ShippingMethodRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\CountryRepository;
use App\Repository\Front\CurrencyRepository as CurrencyFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use App\Repository\Front\OrderHistoryRepository as OrderHistoryFrontRepository;
use App\Repository\Front\OrderProductRepository as OrderProductFrontRepository;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use App\Repository\Front\OrderSimpleFieldsRepository as OrderSimpleFieldsFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Repository\Front\ZoneRepository as ZoneFrontRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use App\Service\Synchronizer\BackToFront\CustomerSynchronizer as CustomerBackToFrontSynchronizer;
use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class OrderSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var EventDispatcherInterface $eventDispatcher */
    protected $eventDispatcher;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var ShippingMethodRepository $shippingMethodsRepository */
    protected $shippingMethodsRepository;

    /** @var PaymentTypeRepository $paymentTypeRepository */
    protected $paymentTypeRepository;

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

    /** @var CountryRepository $countryRepository */
    protected $countryRepository;

    /** @var OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository */
    protected $orderSimpleFieldsFrontRepository;

    /** @var OrderHistoryFrontRepository $orderHistoryFrontRepository */
    protected $orderHistoryFrontRepository;

    /** @var ZoneFrontRepository $zoneFrontRepository */
    protected $zoneFrontRepository;

    /** @var OrderSynchronizerHelper $orderSynchronizerHelper */
    protected $orderSynchronizerHelper;

    /** @var CustomerBackToFrontSynchronizer $customerBackToFrontSynchronizer */
    protected $customerBackToFrontSynchronizer;

    /** @var int[] $excludeCustomerIds */
    protected $excludeCustomerIds = [];

    /**
     * OrderSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param EventDispatcherInterface $eventDispatcher
     * @param StoreFront $storeFront
     * @param ShippingMethodRepository $shippingMethodsRepository
     * @param PaymentTypeRepository $paymentTypeRepository
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
     * @param CountryRepository $countryRepository
     * @param OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository
     * @param ZoneFrontRepository $zoneFrontRepository
     * @param OrderHistoryFrontRepository $orderHistoryFrontRepository
     * @param OrderSynchronizerHelper $orderSynchronizerHelper
     * @param CustomerBackToFrontSynchronizer $customerBackToFrontSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        EventDispatcherInterface $eventDispatcher,
        StoreFront $storeFront,
        ShippingMethodRepository $shippingMethodsRepository,
        PaymentTypeRepository $paymentTypeRepository,
        CurrencyFrontRepository $currencyFrontRepository,
        CustomerRepository $customerRepository,
        CustomerFrontRepository $customerFrontRepository,
        OrderRepository $orderRepository,
        OrderFrontRepository $orderFrontRepository,
        OrderProductFrontRepository $orderProductFrontRepository,
        OrderBackRepository $orderBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductDescriptionFrontRepository $productDescriptionFrontRepository,
        ProductRepository $productRepository,
        CountryRepository $countryRepository,
        OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository,
        ZoneFrontRepository $zoneFrontRepository,
        OrderHistoryFrontRepository $orderHistoryFrontRepository,
        OrderSynchronizerHelper $orderSynchronizerHelper,
        CustomerBackToFrontSynchronizer $customerBackToFrontSynchronizer
    )
    {
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;
        $this->storeFront = $storeFront;
        $this->shippingMethodsRepository = $shippingMethodsRepository;
        $this->paymentTypeRepository = $paymentTypeRepository;
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
        $this->countryRepository = $countryRepository;
        $this->orderSimpleFieldsFrontRepository = $orderSimpleFieldsFrontRepository;
        $this->zoneFrontRepository = $zoneFrontRepository;
        $this->orderHistoryFrontRepository = $orderHistoryFrontRepository;
        $this->orderSynchronizerHelper = $orderSynchronizerHelper;
        $this->customerBackToFrontSynchronizer = $customerBackToFrontSynchronizer;
    }

    /**
     * @param OrderBack $orderBack
     * @return OrderFront
     */
    public function synchronizeOrder(OrderBack $orderBack): OrderFront
    {
        $order = $this->orderRepository->findOneByBackId($orderBack->getId());
        $orderFront = $this->getOrderFrontFromOrder($order);
        $this->updateOrderFrontFromOrderBack($orderFront, $orderBack);
        $order = $this->createOrUpdateOrder($order, $orderBack->getId(), $orderFront->getOrderId());

        $this->eventDispatcher->dispatch(new OrderSynchronizedEvent($order));

        return $orderFront;
    }

    /**
     * @param Order|null $order
     * @return OrderFront
     */
    public function getOrderFrontFromOrder(?Order $order): OrderFront
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
     * @param int $orderFrontId
     * @param int $productFrontId
     * @return OrderProductFront
     */
    public function getOrderProductFrontFromOrderFrontIdAndProductFrontId(
        int $orderFrontId,
        int $productFrontId
    ): OrderProductFront
    {
        $orderProductFront = $this->orderProductFrontRepository->findOneByOrderFrontIdAndProductFrontId(
            $orderFrontId,
            $productFrontId
        );

        if (null === $orderProductFront) {
            $orderProductFront = new OrderProductFront();
        }

        return $orderProductFront;
    }

    /**
     * @param OrderFront $orderFront
     * @param OrderBack $mainOrderBack
     * @return OrderFront
     */
    public function updateOrderFrontAndOtherFromOrderBack(OrderFront $orderFront, OrderBack $mainOrderBack): OrderFront
    {
        $orderFront = $this->updateOrderFrontFromOrderBack($orderFront, $mainOrderBack);
        $this->updateOrderHistoryFrontFromOrderBack($orderFront);
        $ordersBack = $this->orderBackRepository->findByOrderNum($mainOrderBack->getId());
        foreach ($ordersBack as $orderBack) {
            $this->updateOrderProductFrontFromOrderBack($orderBack, $orderFront);
        }

        return $orderFront;
    }

    /**
     * @param OrderFront $orderFront
     * @param OrderBack $mainOrderBack
     * @return OrderFront
     */
    public function updateOrderFrontFromOrderBack(OrderFront $orderFront, OrderBack $mainOrderBack): OrderFront
    {
        if (0 === $mainOrderBack->getClientId()) {
            $customerFrontId = 0;
        } else {
            $customerFrontId = $this->orderSynchronizerHelper->getCustomerFrontByCustomerBackId($mainOrderBack);
        }

        $fullName = StoreBack::parseFirstLastName($mainOrderBack->getFio());
        $address = $mainOrderBack->getStreet() . ' ' . $mainOrderBack->getHouse();
        $currency = Store::convertBackToFrontCurrency($mainOrderBack->getCurrencyName());

        $orderFront->setInvoiceNo($this->storeFront->getDefaultInvoiceNo());
        $orderFront->setInvoicePrefix($this->storeFront->getDefaultInvoicePrefix());
        $orderFront->setStoreId($this->storeFront->getDefaultShopId());
        $orderFront->setStoreName($this->storeFront->getStoreName());
        $orderFront->setStoreUrl($this->storeFront->getDefaultSiteUrl());
        $orderFront->setCustomerId($customerFrontId);
        $orderFront->setCustomerGroupId($this->storeFront->getDefaultCustomerGroupId());
        $orderFront->setFirstName($fullName['firstName']);
        $orderFront->setLastName($fullName['lastName']);
        $orderFront->setEmail($mainOrderBack->getMail());
        $orderFront->setTelephone($mainOrderBack->getPhone());
        $orderFront->setFax(Filler::securityString(null));
        $orderFront->setCustomField(Filler::securityString(null));
        $orderFront->setPaymentFirstName($fullName['firstName']);
        $orderFront->setPaymentLastName($fullName['lastName']);
        $orderFront->setPaymentCompany(Filler::securityString(null));
        $orderFront->setPaymentAddress1($address);
        $orderFront->setPaymentAddress2($address);
        $orderFront->setPaymentCity($mainOrderBack->getWarehouse());

        if (null === $orderFront->getPaymentPostCode()) {
            $orderFront->setPaymentPostCode(Filler::securityString(null));
        }

        $countryName = Filler::securityString($mainOrderBack->getRegion());

        $countryFront = $this->countryRepository->findOneByName($countryName);
        if (null === $countryFront) {
            $countryId = $this->storeFront->getDefaultCountryId();
        } else {
            $countryId = $countryFront->getCountryId();
        }

        $orderFront->setPaymentCountry($countryName);
        $orderFront->setPaymentCountryId($countryId);
        $shippingZone = Filler::securityString($mainOrderBack->getCity());
        $orderFront->setPaymentZone($shippingZone);

        $zone = $this->zoneFrontRepository->findOneByCountryIdAndName($countryId, $shippingZone);
        if (null === $zone) {
            $zoneId = $this->storeFront->getDefaultZoneId();
        } else {
            $zoneId = $zone->getZoneId();
        }

        $orderFront->setPaymentZoneId($zoneId);
        $orderFront->setPaymentAddressFormat(Filler::securityString(null));
        $orderFront->setPaymentCustomField($this->storeFront->getDefaultCustomField());

        $paymentType = $this->paymentTypeRepository->find($mainOrderBack->getPayment());
        if (null === $paymentType || null === $paymentType->getName()) {
            $paymentTypeName = $this->storeFront->getDefaultPaymentMethod();
        } else {
            $paymentTypeName = $paymentType->getName();
        }

        $orderFront->setPaymentMethod($paymentTypeName);
        $paymentCode = PaymentConverter::backToFront($mainOrderBack->getPayment());
        $orderFront->setPaymentCode($paymentCode);
        $orderFront->setShippingFirstName($fullName['firstName']);
        $orderFront->setShippingLastName($fullName['lastName']);
        $orderFront->setShippingCompany(Filler::securityString(null));
        $orderFront->setShippingAddress1($address);
        $orderFront->setShippingAddress2($address);
        $orderFront->setShippingCity($mainOrderBack->getWarehouse());

        if (null === $orderFront->getShippingPostCode()) {
            $orderFront->setShippingPostCode(Filler::securityString(null));
        }

        $orderFront->setShippingCountry($countryName);
        $orderFront->setShippingCountryId($countryId);
        $orderFront->setShippingZone($shippingZone);
        $orderFront->setShippingZoneId($zoneId);

        $orderFront->setShippingAddressFormat(Filler::securityString(null));
        $orderFront->setShippingCustomField($this->storeFront->getDefaultCustomField());

        $shippingMethod = $this->shippingMethodsRepository->find($mainOrderBack->getDelivery());
        if (null === $shippingMethod || null === $shippingMethod->getName()) {
            $shippingMethodName = $this->storeFront->getDefaultShippingMethod();
        } else {
            $shippingMethodName = $shippingMethod->getName();
        }

        $orderFront->setShippingMethod($shippingMethodName);
        $shippingCode = ShippingConverter::backToFront($mainOrderBack->getDelivery());
        $orderFront->setShippingCode($shippingCode);
        $comment = Filler::securityString($mainOrderBack->getComments());
        $orderFront->setComment($comment);

        $total = $this->orderBackRepository->getTotalPrice($mainOrderBack->getOrderNum());
        $orderFront->setTotal($total);
        $orderFront->setOrderStatusId(StoreFront::convertBackToFrontStatusOrder($mainOrderBack->getStatus()));
        $orderFront->setAffiliateId($this->storeFront->getDefaultAffiliateId());
        $orderFront->setCommission($this->storeFront->getDefaultCommission());
        $orderFront->setMarketingId($this->storeFront->getDefaultMarketingId());
        $orderFront->setTracking(Filler::securityString($mainOrderBack->getTrackNumber()));
        $orderFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $orderFront->setCurrencyId($currency['id']);
        $orderFront->setCurrencyCode($currency['code']);

        $currencyValue = $this->currencyFrontRepository->getCurrentCurrency($currency['id']);
        if (null === $currencyValue) {
            $currencyValue = 1.0;
        }

        $orderFront->setCurrencyValue($currencyValue);
        $orderFront->setIp(Filler::securityString($orderFront->getIp()));
        $orderFront->setForwardedIp(Filler::securityString($orderFront->getForwardedIp()));
        $orderFront->setUserAgent(Filler::securityString($orderFront->getUserAgent()));
        $orderFront->setAcceptLanguage(Filler::securityString($orderFront->getAcceptLanguage()));

        $date = new DateTime();
        $date->setTimestamp($mainOrderBack->getTime());

        if (null === $orderFront->getDateAdded()) {
            $orderFront->setDateAdded($date);
        }

        $orderFront->setDateModified($date);

        $this->orderFrontRepository->persistAndFlush($orderFront);

        return $orderFront;
    }

    /**
     * @param OrderBack $orderBack
     * @param OrderFront $orderFront
     * @return OrderProductFront|null
     */
    public function updateOrderProductFrontFromOrderBack(
        OrderBack $orderBack,
        OrderFront $orderFront
    ): ?OrderProductFront
    {
        $product = $this->productRepository->findOneByBackId($orderBack->getProductId());

        if (null === $product) {
            $message = "Product with for back id {$orderBack->getProductId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());

        if (null === $productFront) {
            $message = "Product front with id: {$product->getFrontId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $productDescriptionFront = $this->productDescriptionFrontRepository->findOneByProductFrontIdAndLanguageId(
            $product->getFrontId(),
            $this->storeFront->getDefaultLanguageId()
        );

        if (null === $productDescriptionFront) {
            $message = "Product Description front with id: {$product->getFrontId()} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $orderProductFront = $this->getOrderProductFrontFromOrderFrontIdAndProductFrontId(
            $orderFront->getOrderId(),
            $product->getFrontId()
        );

        $orderProductFront->setOrderId($orderFront->getOrderId());
        $orderProductFront->setProductId($product->getFrontId());
        $orderProductFront->setName(Store::encodingConvert($productDescriptionFront->getName()));
        $orderProductFront->setModel(Store::encodingConvert($productFront->getModel()));
        $orderProductFront->setQuantity($orderBack->getAmount());
        $orderProductFront->setPrice($orderBack->getPrice());

        $total = $orderBack->getAmount() * $orderBack->getPrice();
        $orderProductFront->setTotal($total);
        $orderProductFront->setTax($this->storeFront->getDefaultTax());
        $orderProductFront->setReward($this->storeFront->getDefaultReward());

        $this->orderProductFrontRepository->persistAndFlush($orderProductFront);

        return $orderProductFront;
    }

    /**
     * @param OrderFront $orderFront
     * @return OrderHistoryFront
     */
    public function updateOrderHistoryFrontFromOrderBack(OrderFront $orderFront): OrderHistoryFront
    {
        $this->orderHistoryFrontRepository->removeAllByOrderFrontId($orderFront->getOrderId());

        $orderHistoryFront = new OrderHistoryFront();
        $orderHistoryFront->setOrderId($orderFront->getOrderId());
        $orderHistoryFront->setOrderStatusId($orderFront->getOrderStatusId());
        $orderHistoryFront->setNotify(false);
        $orderHistoryFront->setComment(Filler::securityString(null));
        $orderHistoryFront->setDateAdded(new DateTime());

        $this->orderHistoryFrontRepository->persistAndFlush($orderHistoryFront);

        return $orderHistoryFront;
    }

    /**
     * @param Order|null $order
     * @param int $backId
     * @param int $frontId
     * @return Order
     */
    public function createOrUpdateOrder(?Order $order, int $backId, int $frontId): Order
    {
        if (null === $order) {
            $order = new Order();
        }

        $order->setBackId($backId);
        $order->setFrontId($frontId);

        $this->orderRepository->persistAndFlush($order);

        return $order;
    }
}