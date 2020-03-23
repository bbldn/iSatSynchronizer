<?php

namespace App\Service\Synchronizer;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Order;
use App\Other\Store;
use App\Repository\Back\BuyersGamePostRepository as CustomerBack;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
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
    private $customerBack;
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
    private $store;

    public function __construct(CustomerBack $customerBack,
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
                                Store $store)
    {
        $this->customerBack = $customerBack;
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
        $this->store = $store;
    }

    public function clear()
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

    public function synchronize()
    {
//        $ordersFront = $this->orderFrontRepository->findAll();
//
//        foreach ($ordersFront as $orderFront) {
//            $orderBack = $this->createOrderFrontFromBackOrder($orderFront);
//            $this->createOrder($orderBack, $orderFront);
//        }
    }

    protected function createOrder(OrderBack $orderBack, OrderFront $orderFront)
    {
        $order = new Order();
        $order->setFrontId($orderFront->getOrderId());
        $order->setBackId($orderBack->getId());
        $this->orderRepository->saveAndFlush($order);
    }

    protected function createOrderFrontFromBackOrder(OrderFront $orderFront)
    {
        $orderBack = new OrderBack();
        $orderBack->setType('Покупка');

        $orderProductFront = $this->orderProductRepository->find($orderFront->getOrderId());

        if (null === $orderProductFront) {
            //@TODO Notify
            return $orderBack;
        }

        $product = $this->productRepository->findOneByFrontId($orderProductFront->getProductId());

        if (null === $product) {
            //@TODO Notify
            return $orderBack;
        }

        $orderBack->setProductName($orderProductFront->getName());
        $orderBack->setProductId($product->getBackId());
        $orderBack->setPrice($orderProductFront->getPrice());
        $orderBack->setAmount($orderProductFront->getQuantity());
        $orderBack->setCurrencyName($this->store->convertFrontToBackCurrency($orderFront->getCurrencyCode()));
        $orderBack->setParentName($this->getMainCategoryNameByProductFrontId($orderProductFront->getProductId()));
        $orderBack->setPhone($orderFront->getTelephone());
        $orderBack->setFio($orderFront->getLastName() . ' ' . $orderFront->getFirstName());
        $orderBack->setRegion($orderFront->getShippingZone());
        $orderBack->setCity($orderFront->getShippingCity());
        $orderBack->setStreet('');
        $orderBack->setHouse('');
        $orderBack->setWarehouse('');
        $orderBack->setMail($orderFront->getEmail());
        $orderBack->setStatus($this->store->getDefaultOrderStatus());
        $orderBack->setComments($orderFront->getComment());
        $orderBack->setArchive(0);
        $orderBack->setRead(0);
        $orderBack->setSynchronize(0);

        $orderBack->setClientId($this->getClientIdByFrontCustomerPhone($orderFront->getTelephone()));
        $orderBack->setPayment(13);

        //TODO Пока так потом надо будет писать решение
        $orderBack->setDelivery(21);

        $orderBack->setTrackNumber('');
        $orderBack->setTrackNumberDate(new \DateTime());
        $orderBack->setMoneyGiven(0);
        $orderBack->setTrackSent(0);
        $orderBack->setSerialNum('');
        $orderBack->setShopId($this->store->getDefaultShop());
        $orderBack->setShopIdCounterparty(0);
        $orderBack->setPaymentWaitDays(0);
        $orderBack->setPaymentWaitFirstSum(0);
        $orderBack->setPaymentDate(new \DateTime());
        $orderBack->setDocumentId(0);
        $orderBack->setDocumentType(2);
        $orderBack->setInvoiceSent(new \DateTime());

        //TODO Разобраться с курсом для разных валют
        $orderBack->setCurrencyValue(1);
        $orderBack->setCurrencyValueWhenPurchasing(json_encode($this->getCurrentCourse()));


        $orderBack->setShippingPrice(0);
        $orderBack->setShippingPriceOld(0);
        $orderBack->setShippingCurrencyName('');
        $orderBack->setShippingCurrencyValue(0);

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
//        $customer = $this->customerBack->findOneByTelephone($orderFront->getTelephone());
        $customer = $this->customerBack->findOneByTelephone($phone);
        if (null === $customer) {
            return 0;
        }

        return $customer->getId();
    }
}