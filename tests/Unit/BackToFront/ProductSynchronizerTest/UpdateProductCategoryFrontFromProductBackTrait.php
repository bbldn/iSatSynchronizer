<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Helper\BackToFront\ProductSynchronizerHelper;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;

trait UpdateProductCategoryFrontFromProductBackTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     * @see ProductSynchronizer::updateProductCategoryFrontFromProductBack
     */
    public function testUpdateProductCategoryFrontFromProductBack_ProductCategoryFrontNull()
    {
        $productBack = new ProductBack();
        $productBack->setCategoryId(1);

        $productFront = new ProductFront();
        $productFront->setProductId(1);

        $categoryFront = new CategoryFront();
        $categoryFront->setCategoryId(1);

        $productSynchronizerHelper = $this->getMockBuilder(ProductSynchronizerHelper::class)
            ->setMethods(['getCategoryFrontByCategoryBackId'])
            ->disableOriginalConstructor()
            ->getMock();

        $productSynchronizerHelper->expects($this->once())
            ->method('getCategoryFrontByCategoryBackId')
            ->with($productBack->getCategoryId())
            ->willReturn($categoryFront);

        $this->setProperty(
            $this->productSynchronizer,
            'productSynchronizerHelper',
            $productSynchronizerHelper
        );

        $productCategoryFront = new ProductCategoryFront();
        $productCategoryFront->setProductId($productFront->getProductId());
        $productCategoryFront->setCategoryId($categoryFront->getCategoryId());

        $productCategoryFrontRepository = $this->getMockBuilder(ProductCategoryFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndCategoryId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryFrontRepository->expects($this->once())
            ->method('findOneByProductFrontIdAndCategoryId')
            ->with($productFront->getProductId(), $categoryFront->getCategoryId())
            ->willReturn($productCategoryFront);

        $productCategoryFrontRepository->method('persistAndFlush')->with($productCategoryFront);

        $this->setProperty(
            $this->productSynchronizer,
            'productCategoryFrontRepository',
            $productCategoryFrontRepository
        );

        $productCategoryFrontTest = $this->invokeMethod($this->productSynchronizer, 'updateProductCategoryFrontFromProductBack', [
            $productBack, $productFront
        ]);

        $this->assertSame($productCategoryFront, $productCategoryFrontTest);
    }

    /**
     * @see ProductSynchronizer::updateProductCategoryFrontFromProductBack
     */
    public function testUpdateProductCategoryFrontFromProductBack_CategoryFrontNull()
    {
        $productBack = new ProductBack();
        $productBack->setCategoryId(1);

        $productFront = new ProductFront();
        $productFront->setProductId(1);

        $categoryFront = new CategoryFront();
        $categoryFront->setCategoryId(1);

        $productSynchronizerHelper = $this->getMockBuilder(ProductSynchronizerHelper::class)
            ->setMethods(['getCategoryFrontByCategoryBackId'])
            ->disableOriginalConstructor()
            ->getMock();

        $productSynchronizerHelper->expects($this->once())
            ->method('getCategoryFrontByCategoryBackId')
            ->with($productBack->getCategoryId())
            ->willReturn(null);

        $this->setProperty(
            $this->productSynchronizer,
            'productSynchronizerHelper',
            $productSynchronizerHelper
        );

        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultCategoryFrontId'])
            ->disableOriginalConstructor()
            ->getMock();

        $storeFront->expects($this->once())->method('getDefaultCategoryFrontId')->willReturn(1);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productCategoryFront = new ProductCategoryFront();
        $productCategoryFront->setProductId($productFront->getProductId());
        $productCategoryFront->setCategoryId($categoryFront->getCategoryId());

        $productCategoryFrontRepository = $this->getMockBuilder(ProductCategoryFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndCategoryId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryFrontRepository->expects($this->once())
            ->method('findOneByProductFrontIdAndCategoryId')
            ->with($productFront->getProductId(), $categoryFront->getCategoryId())
            ->willReturn($productCategoryFront);

        $productCategoryFrontRepository->method('persistAndFlush')->with($productCategoryFront);

        $this->setProperty(
            $this->productSynchronizer,
            'productCategoryFrontRepository',
            $productCategoryFrontRepository
        );

        $productCategoryFrontTest = $this->invokeMethod($this->productSynchronizer, 'updateProductCategoryFrontFromProductBack', [
            $productBack, $productFront
        ]);

        $this->assertSame($productCategoryFront, $productCategoryFrontTest);
    }

    /**
     * @see ProductSynchronizer::updateProductCategoryFrontFromProductBack
     */
    public function testUpdateProductCategoryFrontFromProductBack_CategoryFrontNotNull()
    {
        $productBack = new ProductBack();
        $productBack->setCategoryId(1);

        $productFront = new ProductFront();
        $productFront->setProductId(1);

        $categoryFront = new CategoryFront();
        $categoryFront->setCategoryId(1);

        $productSynchronizerHelper = $this->getMockBuilder(ProductSynchronizerHelper::class)
            ->setMethods(['getCategoryFrontByCategoryBackId'])
            ->disableOriginalConstructor()
            ->getMock();

        $productSynchronizerHelper->expects($this->once())
            ->method('getCategoryFrontByCategoryBackId')
            ->with($productBack->getCategoryId())
            ->willReturn($categoryFront);

        $this->setProperty(
            $this->productSynchronizer,
            'productSynchronizerHelper',
            $productSynchronizerHelper
        );

        $productCategoryFront = new ProductCategoryFront();
        $productCategoryFront->setProductId($productFront->getProductId());
        $productCategoryFront->setCategoryId($categoryFront->getCategoryId());

        $productCategoryFrontRepository = $this->getMockBuilder(ProductCategoryFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndCategoryId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryFrontRepository->expects($this->once())
            ->method('findOneByProductFrontIdAndCategoryId')
            ->with($productFront->getProductId(), $categoryFront->getCategoryId())
            ->willReturn($productCategoryFront);

        $productCategoryFrontRepository->method('persistAndFlush')->with($productCategoryFront);

        $this->setProperty(
            $this->productSynchronizer,
            'productCategoryFrontRepository',
            $productCategoryFrontRepository
        );

        $productCategoryFrontTest = $this->invokeMethod($this->productSynchronizer, 'updateProductCategoryFrontFromProductBack', [
            $productBack, $productFront
        ]);

        $this->assertSame($productCategoryFront, $productCategoryFrontTest);
    }
}