<?php

namespace App\Tests\Unit\BackToFront;

use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use App\Tests\Unit\BackToFront\ProductSynchronizerTest\CreateOrUpdateProductTrait;
use App\Tests\Unit\BackToFront\ProductSynchronizerTest\UpdateProductCategoryFrontFromProductBackTrait;
use App\Tests\Unit\BackToFront\ProductSynchronizerTest\UpdateProductDescriptionFrontFromProductBackTrait;
use App\Tests\Unit\BackToFront\ProductSynchronizerTest\UpdateProductLayoutFrontFromProductFrontTrait;
use App\Tests\Unit\BackToFront\ProductSynchronizerTest\UpdateProductStoreFrontFromProductFrontTrait;
use App\Tests\WebTestCase;

class ProductSynchronizerTest extends WebTestCase
{
    use CreateOrUpdateProductTrait;
    use UpdateProductCategoryFrontFromProductBackTrait;
    use UpdateProductStoreFrontFromProductFrontTrait;
    use UpdateProductLayoutFrontFromProductFrontTrait;
    use UpdateProductDescriptionFrontFromProductBackTrait;

    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     *
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->productSynchronizer = self::$container->get(ProductSynchronizer::class);
    }
}