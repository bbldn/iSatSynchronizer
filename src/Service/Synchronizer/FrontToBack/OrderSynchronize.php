<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Order;
use App\Exception\OrderFrontNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Fillers\OrderFiller;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\Back\BuyersGamePostRepository as CustomerBack;
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

class OrderSynchronize
{
    private $storeFront;
    private $storeBack;
    private $customerBack;
    private $orderBackRepository;
    private $orderFrontRepository;
    private $orderHistoryRepository;
    private $orderOptionRepository;
    private $orderProductRepository;
    private $orderRecurringFrontRepository;
    private $orderRecurringTransactionFrontRepository;
    private $orderShipmentFrontRepository;
    private $orderStatusFrontRepository;
    private $orderTotalFrontRepository;
    private $orderVoucherFrontRepository;
    private $orderRepository;
    private $addressFrontRepository;
    private $currencyBackRepository;
    private $categoryDescriptionFrontRepository;
    private $customerFrontRepository;
    private $customerActivityFrontRepository;
    private $customerAffiliateFrontRepository;
    private $customerApprovalFrontRepository;
    private $customerHistoryFrontRepository;
    private $customerIpFrontRepository;
    private $customerLoginFrontRepository;
    private $customerOnlineFrontRepository;
    private $customerRewardFrontRepository;
    private $customerSearchFrontRepository;
    private $customerTransactionFrontRepository;
    private $customerWishListFrontRepository;
    private $productRepository;
    private $productCategoryFrontRepository;


    public function __construct(
        StoreFront $storeFront,
        StoreBack $storeBack,
        CustomerBack $customerBack,
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
        ProductCategoryFrontRepository $productCategoryFrontRepository
    )
    {
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->customerBack = $customerBack;
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
    }

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

    public function synchronizeAll(): void
    {
        $ordersFront = $this->orderFrontRepository->findAll();

        foreach ($ordersFront as $orderFront) {
            $this->synchronizeOrder($orderFront);
        }
    }

    /**
     * @param int $id
     * @throws OrderFrontNotFoundException
     */
    public function synchronizeOne(int $id): void
    {
        $orderFront = $this->orderFrontRepository->find($id);
        if (null === $orderFront) {
            throw new OrderFrontNotFoundException();
        }

        $this->synchronizeOrder($orderFront);
    }

    protected function synchronizeOrder(OrderFront $orderFront): void
    {
        $order = $this->orderRepository->findOneByFrontId($orderFront->getOrderId());
        if (null === $order) {
            $orderBack = $this->createOrderFrontFromBackOrder($orderFront);
            $this->createOrder($orderBack, $orderFront);
        } else {
            $orderBack = $this->orderBackRepository->find($order->getBackId());
            if (null === $orderBack) {
                $orderBack = $this->createOrderFrontFromBackOrder($orderFront);
                $order->setBackId($orderBack->getId());
            } else {
                $this->updateOrderFrontFromBackOrder($orderFront, $orderBack);
            }
            $this->orderRepository->saveAndFlush($order);
        }
    }

    protected function createOrder(OrderBack $orderBack, OrderFront $orderFront): void
    {
        $order = new Order();
        $order->setFrontId($orderFront->getOrderId());
        $order->setBackId($orderBack->getId());
        $this->orderRepository->saveAndFlush($order);
    }

    protected function createOrderFrontFromBackOrder(OrderFront $orderFront): OrderBack
    {
        $orderBackMain = new OrderBack();
        $currentOrderBack = $orderBackMain;
        $orderNum = 0;

        $orderProductsFront = $this->orderProductRepository->findByOrderFrontId($orderFront->getOrderId());

        if (0 === count($orderProductsFront)) {
            //@TODO Notify
            return $orderBackMain;
        }

        foreach ($orderProductsFront as $orderProductFront) {
            if (null !== $orderBackMain->getId()) {
                $currentOrderBack = new OrderBack();
                $orderNum = $orderBackMain->getId();
            }

            $product = $this->productRepository->findOneByFrontId($orderProductFront->getProductId());

            if (null === $product) {
                //@TODO Notify
                return $orderBackMain;
            }

            $currencyCode = $orderFront->getCurrencyCode();
            $courses = $this->getCurrentCourse();
            $currentCourse = $courses[StoreFront::convertCurrency($currencyCode)];
            OrderFiller::frontToBack(
                $orderFront,
                $orderProductFront,
                $product->getBackId(),
                StoreFront::convertCurrency($currencyCode),
                $this->getMainCategoryNameByProductFrontId($orderProductFront->getProductId()),
                $this->storeFront->getDefaultOrderStatus(),
                $this->getClientIdByFrontCustomerPhone($orderFront->getTelephone()),
                $this->storeFront->getDefaultShop(),
                json_encode($courses),
                $orderNum,
                $currentCourse,
                Store::convertToCurrency($orderProductFront->getPrice(), (float)$currentCourse),
                $currentOrderBack
            );

            $this->orderBackRepository->saveAndFlush($currentOrderBack);
            if (0 === $orderNum) {
                $currentOrderBack->setOrderNum($orderBackMain->getId());
                $this->orderBackRepository->saveAndFlush($currentOrderBack);
            }
        }

        return $orderBackMain;
    }

    protected function updateOrderFrontFromBackOrder(OrderFront $orderFront, OrderBack $orderBack): OrderBack
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

            if ($currentOrderBack->getProductId() !== $product->getFrontId()) {
                $currentOrderBack = $this->orderBackRepository->findOneByOrderNumAndProductBackId(
                    $orderBack->getOrderNum(),
                    $product->getBackId()
                );
            }

            if (null === $currentOrderBack) {
                $currentOrderBack = new OrderBack();
            }

            $currencyCode = $orderFront->getCurrencyCode();
            $courses = $this->getCurrentCourse();
            $currentCourse = $courses[StoreFront::convertCurrency($currencyCode)];
            OrderFiller::frontToBack(
                $orderFront,
                $orderProductFront,
                $product->getBackId(),
                StoreFront::convertCurrency($currencyCode),
                $this->getMainCategoryNameByProductFrontId($orderProductFront->getProductId()),
                $this->storeFront->getDefaultOrderStatus(),
                $this->getClientIdByFrontCustomerPhone($orderFront->getTelephone()),
                $this->storeFront->getDefaultShop(),
                json_encode($courses),
                $orderBack->getId(),
                $currentCourse,
                Store::convertToCurrency($orderProductFront->getPrice(), (float)$currentCourse),
                $currentOrderBack
            );

            $this->orderBackRepository->saveAndFlush($currentOrderBack);
        }

        return $orderBack;
    }

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

    protected function getCurrentCourse(): array
    {
        return $this->currencyBackRepository->getCurrentCourse();
    }

    protected function getClientIdByFrontCustomerPhone(string $phone): int
    {
        $customer = $this->customerBack->findOneByTelephone($phone);
        if (null === $customer) {
            return 0;
        }

        return $customer->getId();
    }
}