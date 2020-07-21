<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Entity\Front\Product as ProductFront;
use App\Helper\Front\Store as StoreFront;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use App\Repository\Front\ProductStoreRepository as ProductStoreFrontRepository;
use App\Entity\Front\ProductStore as ProductStoreFront;

trait UpdateProductStoreFrontFromProductBackTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     *
     */
    public function testUpdateProductStoreFrontFromProductFront_ProductStoreFrontNotNull()
    {
        $defaultStoreId = 1;

        $productFront = new ProductFront();
        $productFront->setProductId(1);

        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultStoreId'])
            ->disableOriginalConstructor()
            ->getMock();

        $storeFront->expects($this->atMost(2))
            ->method('getDefaultStoreId')
            ->willReturn($defaultStoreId);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productStoreFrontResult = new ProductStoreFront();
        $productStoreFrontResult->setProductId($productFront->getProductId());
        $productStoreFrontResult->setStoreId($defaultStoreId);

        $productStoreFrontRepository = $this->getMockBuilder(ProductStoreFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndStoreId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        $productStoreFrontRepository
            ->expects($this->once())
            ->method('findOneByProductFrontIdAndStoreId')
            ->with($productFront->getProductId(), $defaultStoreId)
            ->willReturn($productStoreFrontResult);

        $productStoreFrontRepository
            ->expects($this->once())
            ->method('persistAndFlush')
            ->with($productStoreFrontResult);

        $this->setProperty(
            $this->productSynchronizer,
            'productStoreFrontRepository',
            $productStoreFrontRepository
        );

        $productCategoryFrontTest = $this->invokeMethod(
            $this->productSynchronizer,
            'updateProductStoreFrontFromProductFront',
            [$productFront]
        );

        $this->assertSame($productStoreFrontResult, $productCategoryFrontTest);
    }

    /**
     *
     */
    public function testUpdateProductStoreFrontFromProductFront_ProductStoreFrontNull()
    {
        $defaultStoreId = 1;

        $productFront = new ProductFront();
        $productFront->setProductId(1);

        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultStoreId'])
            ->disableOriginalConstructor()
            ->getMock();

        $storeFront->expects($this->atMost(2))
            ->method('getDefaultStoreId')
            ->willReturn($defaultStoreId);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productStoreFrontResult = new ProductStoreFront();
        $productStoreFrontResult->setProductId($productFront->getProductId());
        $productStoreFrontResult->setStoreId($defaultStoreId);

        $productStoreFrontRepository = $this->getMockBuilder(ProductStoreFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndStoreId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        $productStoreFrontRepository
            ->expects($this->once())
            ->method('findOneByProductFrontIdAndStoreId')
            ->with($productFront->getProductId(), $defaultStoreId)
            ->willReturn(null);

        $productStoreFrontRepository
            ->expects($this->once())
            ->method('persistAndFlush')
            ->with($productStoreFrontResult);

        $this->setProperty(
            $this->productSynchronizer,
            'productStoreFrontRepository',
            $productStoreFrontRepository
        );

        $productCategoryFrontTest = $this->invokeMethod(
            $this->productSynchronizer,
            'updateProductStoreFrontFromProductFront',
            [$productFront]
        );

        $this->assertEquals($productStoreFrontResult, $productCategoryFrontTest);
    }
}