<?php

namespace App\Service\Synchronizer\FrontToBack\Implementation;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Order;
use App\Exception\CustomerFrontNotFoundException;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\PaymentConverter;
use App\Helper\ShippingConverter;
use App\Helper\Store;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
use App\Repository\Back\OrderGamePostRepository as OrderBackRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CategoryDescriptionRepository as CategoryDescriptionFrontRepository;
use App\Repository\Front\CustomerActivityRepository as CustomerActivityFrontRepository;
use App\Repository\Front\CustomerAffiliateRepository as CustomerAffiliateFrontRepository;
use App\Repository\Front\CustomerApprovalRepository as CustomerApprovalFrontRepository;
use App\Repository\Front\CustomerHistoryRepository as CustomerHistoryFrontRepository;
use App\Repository\Front\CustomerIpRepository as CustomerIpFrontRepository;
use App\Repository\Front\CustomerLoginRepository as CustomerLoginFrontRepository;
use App\Repository\Front\CustomerOnlineRepository as CustomerOnlineFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use App\Repository\Front\CustomerRewardRepository as CustomerRewardFrontRepository;
use App\Repository\Front\CustomerSearchRepository as CustomerSearchFrontRepository;
use App\Repository\Front\CustomerTransactionRepository as CustomerTransactionFrontRepository;
use App\Repository\Front\CustomerWishListRepository as CustomerWishListFrontRepository;
use App\Repository\Front\OrderHistoryRepository as OrderHistoryFrontRepository;
use App\Repository\Front\OrderOptionRepository as OrderOptionFrontRepository;
use App\Repository\Front\OrderProductRepository as OrderProductFrontRepository;
use App\Repository\Front\OrderRecurringRepository as OrderRecurringFrontRepository;
use App\Repository\Front\OrderRecurringTransactionRepository as OrderRecurringTransactionFrontRepository;
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use App\Repository\Front\OrderShipmentRepository as OrderShipmentFrontRepository;
use App\Repository\Front\OrderSimpleFieldsRepository as OrderSimpleFieldsFrontRepository;
use App\Repository\Front\OrderStatusRepository as OrderStatusFrontRepository;
use App\Repository\Front\OrderTotalRepository as OrderTotalFrontRepository;
use App\Repository\Front\OrderVoucherRepository as OrderVoucherFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Service\Synchronizer\FrontToBack\CustomerSynchronizer as CustomerFrontToBackSynchronizer;
use DateTime;
use Psr\Log\LoggerInterface;

class OrderSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var CustomerBackRepository $customerBackRepository */
    protected $customerBackRepository;

    /** @var OrderBackRepository $orderBackRepository */
    protected $orderBackRepository;

    /** @var OrderFrontRepository $orderFrontRepository */
    protected $orderFrontRepository;

    /** @var OrderHistoryFrontRepository $orderHistoryRepository */
    protected $orderHistoryRepository;

    /** @var OrderOptionFrontRepository $orderOptionRepository */
    protected $orderOptionRepository;

    /** @var OrderProductFrontRepository $orderProductRepository */
    protected $orderProductRepository;

    /** @var OrderRecurringFrontRepository $orderRecurringFrontRepository */
    protected $orderRecurringFrontRepository;

    /** @var OrderRecurringTransactionFrontRepository $orderRecurringTransactionFrontRepository */
    protected $orderRecurringTransactionFrontRepository;

    /** @var OrderShipmentFrontRepository $orderShipmentFrontRepository */
    protected $orderShipmentFrontRepository;

    /** @var OrderStatusFrontRepository $orderStatusFrontRepository */
    protected $orderStatusFrontRepository;

    /** @var OrderTotalFrontRepository $orderTotalFrontRepository */
    protected $orderTotalFrontRepository;

    /** @var OrderVoucherFrontRepository $orderVoucherFrontRepository */
    protected $orderVoucherFrontRepository;

    /** @var OrderRepository $orderRepository */
    protected $orderRepository;

    /** @var AddressFrontRepository $addressFrontRepository */
    protected $addressFrontRepository;

    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository */
    protected $categoryDescriptionFrontRepository;

    /** @var CustomerFrontRepository $customerFrontRepository */
    protected $customerFrontRepository;

    /** @var CustomerActivityFrontRepository $customerActivityFrontRepository */
    protected $customerActivityFrontRepository;

    /** @var CustomerAffiliateFrontRepository $customerAffiliateFrontRepository */
    protected $customerAffiliateFrontRepository;

    /** @var CustomerApprovalFrontRepository $customerApprovalFrontRepository */
    protected $customerApprovalFrontRepository;

    /** @var CustomerHistoryFrontRepository $customerHistoryFrontRepository */
    protected $customerHistoryFrontRepository;

    /** @var CustomerIpFrontRepository $customerIpFrontRepository */
    protected $customerIpFrontRepository;

    /** @var CustomerLoginFrontRepository $customerLoginFrontRepository */
    protected $customerLoginFrontRepository;

    /** @var CustomerOnlineFrontRepository $customerOnlineFrontRepository */
    protected $customerOnlineFrontRepository;

    /** @var CustomerRewardFrontRepository $customerRewardFrontRepository */
    protected $customerRewardFrontRepository;

    /** @var CustomerSearchFrontRepository $customerSearchFrontRepository */
    protected $customerSearchFrontRepository;

    /** @var CustomerTransactionFrontRepository $customerTransactionFrontRepository */
    protected $customerTransactionFrontRepository;

    /** @var CustomerWishListFrontRepository $customerWishListFrontRepository */
    protected $customerWishListFrontRepository;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var ProductCategoryFrontRepository $productCategoryFrontRepository */
    protected $productCategoryFrontRepository;

    /** @var OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository */
    protected $orderSimpleFieldsFrontRepository;

    /** @var CustomerFrontToBackSynchronizer $customerFrontToBackSynchronizer */
    protected $customerFrontToBackSynchronizer;

    /**
     * OrderSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param CustomerBackRepository $customerBackRepository
     * @param OrderBackRepository $orderBackRepository
     * @param OrderFrontRepository $orderFrontRepository
     * @param OrderHistoryFrontRepository $orderHistoryRepository
     * @param OrderOptionFrontRepository $orderOptionRepository
     * @param OrderProductFrontRepository $orderProductRepository
     * @param OrderRecurringFrontRepository $orderRecurringFrontRepository
     * @param OrderRecurringTransactionFrontRepository $orderRecurringTransactionFrontRepository
     * @param OrderShipmentFrontRepository $orderShipmentFrontRepository
     * @param OrderStatusFrontRepository $orderStatusFrontRepository
     * @param OrderTotalFrontRepository $orderTotalFrontRepository
     * @param OrderVoucherFrontRepository $orderVoucherFrontRepository
     * @param OrderRepository $orderRepository
     * @param AddressFrontRepository $addressFrontRepository
     * @param CurrencyBackRepository $currencyBackRepository
     * @param CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository
     * @param CustomerFrontRepository $customerFrontRepository
     * @param CustomerActivityFrontRepository $customerActivityFrontRepository
     * @param CustomerAffiliateFrontRepository $customerAffiliateFrontRepository
     * @param CustomerApprovalFrontRepository $customerApprovalFrontRepository
     * @param CustomerHistoryFrontRepository $customerHistoryFrontRepository
     * @param CustomerIpFrontRepository $customerIpFrontRepository
     * @param CustomerLoginFrontRepository $customerLoginFrontRepository
     * @param CustomerOnlineFrontRepository $customerOnlineFrontRepository
     * @param CustomerRewardFrontRepository $customerRewardFrontRepository
     * @param CustomerSearchFrontRepository $customerSearchFrontRepository
     * @param CustomerTransactionFrontRepository $customerTransactionFrontRepository
     * @param CustomerWishListFrontRepository $customerWishListFrontRepository
     * @param ProductRepository $productRepository
     * @param ProductCategoryFrontRepository $productCategoryFrontRepository
     * @param OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository
     * @param CustomerFrontToBackSynchronizer $customerFrontToBackSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        StoreBack $storeBack,
        CustomerBackRepository $customerBackRepository,
        OrderBackRepository $orderBackRepository,
        OrderFrontRepository $orderFrontRepository,
        OrderHistoryFrontRepository $orderHistoryRepository,
        OrderOptionFrontRepository $orderOptionRepository,
        OrderProductFrontRepository $orderProductRepository,
        OrderRecurringFrontRepository $orderRecurringFrontRepository,
        OrderRecurringTransactionFrontRepository $orderRecurringTransactionFrontRepository,
        OrderShipmentFrontRepository $orderShipmentFrontRepository,
        OrderStatusFrontRepository $orderStatusFrontRepository,
        OrderTotalFrontRepository $orderTotalFrontRepository,
        OrderVoucherFrontRepository $orderVoucherFrontRepository,
        OrderRepository $orderRepository,
        AddressFrontRepository $addressFrontRepository,
        CurrencyBackRepository $currencyBackRepository,
        CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository,
        CustomerFrontRepository $customerFrontRepository,
        CustomerActivityFrontRepository $customerActivityFrontRepository,
        CustomerAffiliateFrontRepository $customerAffiliateFrontRepository,
        CustomerApprovalFrontRepository $customerApprovalFrontRepository,
        CustomerHistoryFrontRepository $customerHistoryFrontRepository,
        CustomerIpFrontRepository $customerIpFrontRepository,
        CustomerLoginFrontRepository $customerLoginFrontRepository,
        CustomerOnlineFrontRepository $customerOnlineFrontRepository,
        CustomerRewardFrontRepository $customerRewardFrontRepository,
        CustomerSearchFrontRepository $customerSearchFrontRepository,
        CustomerTransactionFrontRepository $customerTransactionFrontRepository,
        CustomerWishListFrontRepository $customerWishListFrontRepository,
        ProductRepository $productRepository,
        ProductCategoryFrontRepository $productCategoryFrontRepository,
        OrderSimpleFieldsFrontRepository $orderSimpleFieldsFrontRepository,
        CustomerFrontToBackSynchronizer $customerFrontToBackSynchronizer
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->customerBackRepository = $customerBackRepository;
        $this->orderBackRepository = $orderBackRepository;
        $this->orderFrontRepository = $orderFrontRepository;
        $this->orderHistoryRepository = $orderHistoryRepository;
        $this->orderOptionRepository = $orderOptionRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->orderRecurringFrontRepository = $orderRecurringFrontRepository;
        $this->orderRecurringTransactionFrontRepository = $orderRecurringTransactionFrontRepository;
        $this->orderShipmentFrontRepository = $orderShipmentFrontRepository;
        $this->orderStatusFrontRepository = $orderStatusFrontRepository;
        $this->orderTotalFrontRepository = $orderTotalFrontRepository;
        $this->orderVoucherFrontRepository = $orderVoucherFrontRepository;
        $this->orderRepository = $orderRepository;
        $this->addressFrontRepository = $addressFrontRepository;
        $this->currencyBackRepository = $currencyBackRepository;
        $this->categoryDescriptionFrontRepository = $categoryDescriptionFrontRepository;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerActivityFrontRepository = $customerActivityFrontRepository;
        $this->customerAffiliateFrontRepository = $customerAffiliateFrontRepository;
        $this->customerApprovalFrontRepository = $customerApprovalFrontRepository;
        $this->customerHistoryFrontRepository = $customerHistoryFrontRepository;
        $this->customerIpFrontRepository = $customerIpFrontRepository;
        $this->customerLoginFrontRepository = $customerLoginFrontRepository;
        $this->customerOnlineFrontRepository = $customerOnlineFrontRepository;
        $this->customerRewardFrontRepository = $customerRewardFrontRepository;
        $this->customerSearchFrontRepository = $customerSearchFrontRepository;
        $this->customerTransactionFrontRepository = $customerTransactionFrontRepository;
        $this->customerWishListFrontRepository = $customerWishListFrontRepository;
        $this->productRepository = $productRepository;
        $this->productCategoryFrontRepository = $productCategoryFrontRepository;
        $this->orderSimpleFieldsFrontRepository = $orderSimpleFieldsFrontRepository;
        $this->customerFrontToBackSynchronizer = $customerFrontToBackSynchronizer;
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->orderRepository->removeAll();
        $this->orderFrontRepository->removeAll();
        $this->orderHistoryRepository->removeAll();
        $this->orderOptionRepository->removeAll();
        $this->orderProductRepository->removeAll();
        $this->orderRecurringFrontRepository->removeAll();
        $this->orderRecurringTransactionFrontRepository->removeAll();
        $this->orderShipmentFrontRepository->removeAll();
        $this->orderTotalFrontRepository->removeAll();
        $this->orderVoucherFrontRepository->removeAll();
        $this->addressFrontRepository->removeAll();
        $this->customerFrontRepository->removeAll();
        $this->customerActivityFrontRepository->removeAll();
        $this->customerAffiliateFrontRepository->removeAll();
        $this->customerApprovalFrontRepository->removeAll();
        $this->customerHistoryFrontRepository->removeAll();
        $this->customerIpFrontRepository->removeAll();
        $this->customerLoginFrontRepository->removeAll();
        $this->customerOnlineFrontRepository->removeAll();
        $this->customerRewardFrontRepository->removeAll();
        $this->customerSearchFrontRepository->removeAll();
        $this->customerTransactionFrontRepository->removeAll();
        $this->customerWishListFrontRepository->removeAll();

        $this->orderRepository->resetAutoIncrements();
        $this->orderFrontRepository->resetAutoIncrements();
        $this->orderHistoryRepository->resetAutoIncrements();
        $this->orderOptionRepository->resetAutoIncrements();
        $this->orderProductRepository->resetAutoIncrements();
        $this->orderRecurringFrontRepository->resetAutoIncrements();
        $this->orderRecurringTransactionFrontRepository->resetAutoIncrements();
        $this->orderShipmentFrontRepository->resetAutoIncrements();
        $this->orderTotalFrontRepository->resetAutoIncrements();
        $this->orderVoucherFrontRepository->resetAutoIncrements();
        $this->addressFrontRepository->resetAutoIncrements();
        $this->customerFrontRepository->resetAutoIncrements();
        $this->customerActivityFrontRepository->resetAutoIncrements();
        $this->customerApprovalFrontRepository->resetAutoIncrements();
        $this->customerHistoryFrontRepository->resetAutoIncrements();
        $this->customerIpFrontRepository->resetAutoIncrements();
        $this->customerRewardFrontRepository->resetAutoIncrements();
        $this->customerSearchFrontRepository->resetAutoIncrements();
        $this->customerTransactionFrontRepository->resetAutoIncrements();
        $this->customerWishListFrontRepository->resetAutoIncrements();

        if (true === $this->orderSimpleFieldsFrontRepository->tableExists()) {
            $this->orderSimpleFieldsFrontRepository->removeAll();
            $this->orderSimpleFieldsFrontRepository->resetAutoIncrements();
        }
    }

    /**
     * @param OrderFront $orderFront
     */
    protected function synchronizeOrder(OrderFront $orderFront): void
    {
        $order = $this->orderRepository->findOneByFrontId($orderFront->getOrderId());
        $orderBack = $this->getOrderBackFromOrder($order);
        $this->updateOrderBackFromOrderFront($orderFront, $orderBack);
        $this->createOrUpdateOrder($order, $orderBack->getId(), $orderFront->getOrderId());
    }

    /**
     * @param Order|null $order
     * @return OrderBack
     */
    protected function getOrderBackFromOrder(?Order $order): OrderBack
    {
        if (null === $order) {
            return new OrderBack();
        }

        $orderBack = $this->orderBackRepository->find($order->getBackId());

        if (null === $orderBack) {
            return new OrderBack();
        }

        return $orderBack;
    }

    /**
     * @param OrderFront $orderFront
     * @param OrderBack $orderBack
     * @return OrderBack
     */
    protected function updateOrderBackFromOrderFront(OrderFront $orderFront, OrderBack $orderBack): OrderBack
    {
        $orderProductsFront = $this->orderProductRepository->findByOrderFrontId($orderFront->getOrderId());
        $currentOrderBack = $orderBack;

        if (0 === count($orderProductsFront)) {
            $message = "Order without products: {$orderFront->getOrderId()}";
            $this->logger->error(ExceptionFormatter::f($message));

            return $orderBack;
        }

        foreach ($orderProductsFront as $orderProductFront) {
            $product = $this->productRepository->findOneByFrontId($orderProductFront->getProductId());

            if (null === $product) {
                $error = "Product with id: {$orderProductFront->getProductId()} not found";
                $this->logger->error(ExceptionFormatter::f($error));

                return $orderBack;
            }

            if ($currentOrderBack->getProductId() !== $product->getBackId()) {
                if (null !== $orderBack->getOrderNum() && null !== $product->getBackId()) {
                    $currentOrderBack = $this->orderBackRepository->findOneByOrderNumAndProductBackId(
                        $orderBack->getOrderNum(),
                        $product->getBackId()
                    );
                }
            }

            if (null === $currentOrderBack) {
                $currentOrderBack = new OrderBack();
            }

            $currencyCode = $orderFront->getCurrencyCode();
            $courses = $this->getCurrentCourse();
            $currentCourse = $courses[Store::convertFrontToBackCurrency($currencyCode)];

            $orderNum = 0;
            if (null !== $orderBack->getId()) {
                $orderNum = $orderBack->getId();
            }

            $currentOrderBack->setType('Покупка');
            $currentOrderBack->setProductName($orderProductFront->getName());
            $currentOrderBack->setProductId($product->getBackId());
            $currentOrderBack->setPrice($orderProductFront->getPrice());
            $currentOrderBack->setAmount($orderProductFront->getQuantity());
            $currentOrderBack->setCurrencyName(Store::convertFrontToBackCurrency($currencyCode));
            $currentOrderBack->setParentName(
                $this->getMainCategoryNameByProductFrontId($orderProductFront->getProductId())
            );
            $currentOrderBack->setPhone(Store::normalizePhone($orderFront->getTelephone()));
            $currentOrderBack->setFio("{$orderFront->getLastName()} {$orderFront->getFirstName()}");
            $currentOrderBack->setStreet($orderFront->getShippingAddress1());
            $currentOrderBack->setHouse(Filler::securityString(null));
            $currentOrderBack->setMail($orderFront->getEmail());
            $currentOrderBack->setWhant(Filler::securityString($orderFront->getComment()));
            $currentOrderBack->setVipNum(Filler::securityString(null));

            if (null === $orderFront->getDateAdded()) {
                $time = time();
            } else {
                $time = $orderFront->getDateAdded()->getTimestamp();
            }

            $currentOrderBack->setTime($time);
            $currentOrderBack->setStatus($orderFront->getOrderStatusId());

            if (null === $currentOrderBack->getComments()) {
                $currentOrderBack->setComments(Filler::securityString(null));
            }

            if (null === $currentOrderBack->getArchive()) {
                $currentOrderBack->setArchive(0);
            }

            $currentOrderBack->setRead(0);
            if (null === $currentOrderBack->getSynchronize()) {
                $currentOrderBack->setSynchronize(false);
            }
            $currentOrderBack->setClientId($this->getClientIdByFrontCustomerPhone($orderFront));

            $paymentId = PaymentConverter::frontToBack(Filler::securityString($orderFront->getPaymentCode()));
            $currentOrderBack->setPayment($paymentId);

            $shippingCode = Filler::securityString($orderFront->getShippingCode());
            $shippingId = ShippingConverter::frontToBack(Filler::securityString($orderFront->getShippingCode()));
            $currentOrderBack->setDelivery($shippingId);

            if ('novaposhta.novaposhta' === $shippingCode) {
                if (true === $this->orderSimpleFieldsFrontRepository->tableExists()) {
                    $orderSimpleFields = $this->orderSimpleFieldsFrontRepository->find($orderFront->getOrderId());
                } else {
                    $orderSimpleFields = null;
                }
            } else {
                $orderSimpleFields = null;
            }

            if (null !== $orderSimpleFields) {
                $currentOrderBack->setRegion($orderSimpleFields->getOblast());
                $currentOrderBack->setCity($orderSimpleFields->getGorod());
                $currentOrderBack->setWarehouse($orderSimpleFields->getOtdelenie());
            } else {
                $currentOrderBack->setRegion($orderFront->getPaymentCountry());
                $currentOrderBack->setCity($orderFront->getPaymentZone());
                $currentOrderBack->setWarehouse(Filler::securityString($orderFront->getShippingCity()));
            }

            $currentOrderBack->setOrderNum($orderNum);

            $tracking = Filler::securityString($orderFront->getTracking());

            if (0 === mb_strlen($tracking)) {
                $currentOrderBack->setTrackNumber($tracking);
                $currentOrderBack->setTrackNumberDate(new DateTime('0000-00-00 00:00:00'));
            } else {
                $currentOrderBack->setTrackNumber($tracking);
                if (null === $currentOrderBack->getTrackNumberDate()) {
                    $currentOrderBack->setTrackNumberDate(new DateTime());
                }
            }

            if (null === $currentOrderBack->getMoneyGiven()) {
                $currentOrderBack->setMoneyGiven(false);
            }

            if (null === $currentOrderBack->getTrackSent()) {
                $currentOrderBack->setTrackSent(false);
            }

            if (null === $currentOrderBack->getSerialNum()) {
                $currentOrderBack->setSerialNum('');
            }

            if (null === $currentOrderBack->getShopId()) {
                $currentOrderBack->setShopId($this->storeBack->getDefaultSiteId());
            }

            if (null === $currentOrderBack->getShopIdCounterparty()) {
                $currentOrderBack->setShopIdCounterparty(0);
            }

            if (null === $currentOrderBack->getPaymentWaitDays()) {
                $currentOrderBack->setPaymentWaitDays(0);
            }

            $currentOrderBack->setPaymentWaitFirstSum(0);

            if (null === $currentOrderBack->getPaymentDate()) {
                $currentOrderBack->setPaymentDate($orderFront->getDateAdded());
            } else {
                $currentOrderBack->setPaymentDate(new DateTime('0000-00-00 00:00:00'));
            }

            $currentOrderBack->setDocumentId(0);

            if (null === $currentOrderBack->getDocumentType()) {
                $currentOrderBack->setDocumentType(2);
            }

            if (null === $currentOrderBack->getInvoiceSent()) {
                $currentOrderBack->setInvoiceSent(new DateTime('0000-00-00 00:00:00'));
            }

            $currentOrderBack->setCurrencyValue($currentCourse);
            $currentOrderBack->setCurrencyValueWhenPurchasing(json_encode($courses));
            $currentOrderBack->setShippingPrice(0);
            $currentOrderBack->setShippingPriceOld(0);

            if (null === $currentOrderBack->getShippingCurrencyName()) {
                $currentOrderBack->setShippingCurrencyName(Filler::securityString(null));
            }

            if (null === $currentOrderBack->getShippingCurrencyValue()) {
                $currentOrderBack->setShippingCurrencyValue(0);
            }

            $this->orderBackRepository->persistAndFlush($currentOrderBack);

            if (0 === $orderNum) {
                $currentOrderBack->setOrderNum($orderBack->getId());
                $this->orderBackRepository->persistAndFlush($currentOrderBack);
            }
        }

        return $orderBack;
    }

    /**
     * @return array
     */
    protected function getCurrentCourse(): array
    {
        return $this->currencyBackRepository->getCurrentCourse();
    }

    /**
     * @param int $frontId
     * @return string
     */
    protected function getMainCategoryNameByProductFrontId(int $frontId): string
    {
        $productCategories = $this->productCategoryFrontRepository->findByProductFrontId($frontId);

        if (0 === count($productCategories)) {
            $error = "ProductCategoryFront not found {$frontId}";
            $this->logger->error(ExceptionFormatter::f($error));

            return '';
        }

        $categoryProduct = $productCategories[0];
        $categoryDescription = $this->categoryDescriptionFrontRepository->find($categoryProduct->getCategoryId());

        if (null === $categoryDescription) {
            $error = "Category Description with id: {$categoryProduct->getCategoryId()} does not found";
            $this->logger->error(ExceptionFormatter::f($error));

            return '';
        }

        return $categoryDescription->getName();
    }

    /**
     * @param OrderFront $orderFront
     * @return int
     */
    protected function getClientIdByFrontCustomerPhone(OrderFront $orderFront): int
    {
        $phone = Store::normalizePhone($orderFront->getTelephone());
        $customerBack = $this->customerBackRepository->findOneByTelephone($phone);
        if (null !== $customerBack) {
            return $customerBack->getId();
        }

        if ($orderFront->getCustomerId() > 0) {
            try {
                $password = rand(10000000, 99999999);
                $customerBack = $this->customerFrontToBackSynchronizer->synchronizeOne($orderFront->getCustomerId(), $password);
            } catch (CustomerFrontNotFoundException $e) {
                $customerBack = null;
            }

            if (null !== $customerBack) {
                return $customerBack->getId();
            }
        }

        $customerBack = new CustomerBack();
        $this->customerFrontToBackSynchronizer->updateCustomerBackFromOrderFront($orderFront, $customerBack);

        return $customerBack->getId();
    }

    /**
     * @param Order $order
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