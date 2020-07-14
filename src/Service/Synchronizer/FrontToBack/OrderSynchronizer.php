<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Contract\FrontToBack\OrderSynchronizerContract;
use App\Service\Synchronizer\FrontToBack\Implementation\OrderSynchronizer as OrderBaseSynchronizer;

class OrderSynchronizer extends OrderBaseSynchronizer implements OrderSynchronizerContract
{
    /**
     *
     */
    public function synchronizeAll(): void
    {
        $ordersFront = $this->orderFrontRepository->findAll();
        foreach ($ordersFront as $orderFront) {
            $this->synchronizeOrder($orderFront);
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $ordersFront = $this->orderFrontRepository->findByIds($ids);
        foreach ($ordersFront as $orderFront) {
            $this->synchronizeOrder($orderFront);
        }
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
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }

    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }
}