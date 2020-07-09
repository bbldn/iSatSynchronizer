<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductDiscountSynchronizerContract;
use App\Service\Synchronizer\BackToFront\Implementation\ProductDiscountSynchronizer as ProductDiscountBaseSynchronizer;

class ProductDiscountSynchronizer extends ProductDiscountBaseSynchronizer implements ProductDiscountSynchronizerContract
{
}