<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Repository\Back\BuyersGroupsPricesRepository as ProductDiscountBackRepository;
use App\Repository\Front\ProductDiscountRepository as ProductDiscountFrontRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;

class ProductDiscountSpeedSynchronizer extends BackToFrontSynchronizer
{
    /** @var ProductDiscountBackRepository $productDiscountBackRepository */
    protected $productDiscountBackRepository;

    /** @var ProductDiscountFrontRepository $productDiscountFrontRepository */
    protected $productDiscountFrontRepository;

    public function __construct(
        ProductDiscountBackRepository $productDiscountBackRepository,
        ProductDiscountFrontRepository $productDiscountFrontRepository
    )
    {
        $this->productDiscountBackRepository = $productDiscountBackRepository;
        $this->productDiscountFrontRepository = $productDiscountFrontRepository;
    }

    public function synchronizeAll(): void
    {
        $prices = $this->productDiscountBackRepository->getAllPrices();
    }
}