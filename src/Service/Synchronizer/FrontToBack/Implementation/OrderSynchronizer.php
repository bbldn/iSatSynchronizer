<?php

namespace App\Service\Synchronizer\FrontToBack\Implementation;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Order;
use App\Exception\CustomerFrontNotFoundException;
use App\Exception\OrderFrontNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Filler;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
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
use App\Repository\Front\OrderStatusRepository as OrderStatusFrontRepository;
use App\Repository\Front\OrderTotalRepository as OrderTotalFrontRepository;
use App\Repository\Front\OrderVoucherRepository as OrderVoucherFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\Str;

class OrderSynchronizer
{
    protected $storeFront;
    protected $storeBack;
    protected $customerBackRepository;
    protected $orderBackRepository;
    protected $orderFrontRepository;
    protected $orderHistoryRepository;
    protected $orderOptionRepository;
    protected $orderProductRepository;
    protected $orderRecurringFrontRepository;
    protected $orderRecurringTransactionFrontRepository;
    protected $orderShipmentFrontRepository;
    protected $orderStatusFrontRepository;
    protected $orderTotalFrontRepository;
    protected $orderVoucherFrontRepository;
    protected $orderRepository;
    protected $addressFrontRepository;
    protected $currencyBackRepository;
    protected $categoryDescriptionFrontRepository;
    protected $customerFrontRepository;
    protected $customerActivityFrontRepository;
    protected $customerAffiliateFrontRepository;
    protected $customerApprovalFrontRepository;
    protected $customerHistoryFrontRepository;
    protected $customerIpFrontRepository;
    protected $customerLoginFrontRepository;
    protected $customerOnlineFrontRepository;
    protected $customerRewardFrontRepository;
    protected $customerSearchFrontRepository;
    protected $customerTransactionFrontRepository;
    protected $customerWishListFrontRepository;
    protected $productRepository;
    protected $productCategoryFrontRepository;
    protected $customerSynchronizer;

    public function __construct(
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
        CustomerSynchronizer $customerSynchronizer
    )
    {
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
        $this->customerSynchronizer = $customerSynchronizer;
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
            //@TODO Notify
            return $orderBack;
        }

        foreach ($orderProductsFront as $orderProductFront) {
            $product = $this->productRepository->findOneByFrontId($orderProductFront->getProductId());

            if (null === $product) {
                //@TODO Notify
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
            $currentCourse = $courses[Store::convertBackToFrontCurrency($currencyCode)];

            $orderNum = 0;
            if (null !== $orderBack->getId()) {
                $orderNum = $orderBack->getId();
            }

            $currentOrderBack->fill(
                'Покупка',
                $orderProductFront->getName(),
                $product->getBackId(),
                $orderProductFront->getPrice(),
                $orderProductFront->getQuantity(),
                Store::convertBackToFrontCurrency($currencyCode),
                $this->getMainCategoryNameByProductFrontId($orderProductFront->getProductId()),
                $orderFront->getTelephone(),
                $orderFront->getLastName() . ' ' . $orderFront->getFirstName(),
                $orderFront->getShippingZone(),
                $orderFront->getShippingCity(),
                $orderFront->getShippingAddress1(),
                $orderFront->getShippingAddress2(),
                Filler::securityString(null),
                $orderFront->getEmail(),
                $orderFront->getComment(),
                Filler::securityString(null),
                time(),
                $this->storeFront->getDefaultOrderStatus(),
                Filler::securityString(null),
                0,
                0,
                0,
                $this->getClientIdByFrontCustomerPhone($orderFront),
                13,
                21,
                $orderNum,
                Filler::securityString(null),
                new \DateTime(),
                0,
                0,
                '',
                $this->storeBack->getDefaultSiteId(),
                0,
                0,
                0,
                new \DateTime(),
                0,
                2,
                new \DateTime(),
                $currentCourse,
                json_encode($courses),
                0,
                0,
                Filler::securityString(null),
                0
            );

            $this->orderBackRepository->persistAndFlush($currentOrderBack);

            if (0 === $orderNum) {
                $currentOrderBack->setOrderNum($orderBack->getId());
                $this->orderBackRepository->persistAndFlush($currentOrderBack);
            }
        }

        return $orderBack;
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
     * @param int $frontId
     * @return string
     */
    protected function getMainCategoryNameByProductFrontId(int $frontId): string
    {
        $productCategories = $this->productCategoryFrontRepository->findByProductFrontId($frontId);

        if (0 === count($productCategories)) {
            //@TODO Notify
            return '';
        }

        $categoryProduct = $productCategories[0];
        $categoryDescription = $this->categoryDescriptionFrontRepository->find($categoryProduct->getCategoryId());

        if (null === $categoryDescription) {
            //@TODO Notify
            return '';
        }

        return $categoryDescription->getName();
    }

    /**
     * @return array
     */
    protected function getCurrentCourse(): array
    {
        return $this->currencyBackRepository->getCurrentCourse();
    }

    protected function getClientIdByFrontCustomerPhone(OrderFront $orderFront): int
    {
        $phone = Store::normalizePhone($orderFront->getTelephone());
        $customerBack = $this->customerBackRepository->findOneByTelephone($phone);
        if (null !== $customerBack) {
            return $customerBack->getId();
        }

        if ($orderFront->getCustomerId() > 0) {
            try {
                $customerBack = $this->customerSynchronizer->synchronizeOne($orderFront->getCustomerId());
            } catch (CustomerFrontNotFoundException $e) {
                $customerBack = null;
            }

            if (null !== $customerBack) {
                return $customerBack->getId();
            }
        }

        $customerBack = new CustomerBack();
        $this->customerSynchronizer->updateCustomerBackFromOrderFront($orderFront, $customerBack);

        return $customerBack->getId();
    }
}