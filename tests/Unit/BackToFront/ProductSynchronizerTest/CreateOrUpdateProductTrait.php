<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;

trait CreateOrUpdateProductTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     * @see ProductSynchronizer::createOrUpdateProduct
     */
    public function testCreateOrUpdateProduct_ProductNotNull()
    {
        $productResult = new Product();
        $productResult->setBackId(1);
        $productResult->setFrontId(2);

        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->setMethods(['persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();
        $productRepository->expects($this->once())->method('persistAndFlush')->with($productResult);

        $this->setProperty($this->productSynchronizer, 'productRepository', $productRepository);

        $productTest = $this->invokeMethod(
            $this->productSynchronizer,
            'createOrUpdateProduct',
            [$productResult, 1, 2]
        );

        $this->assertSame($productResult, $productTest);
    }

    /**
     * @see ProductSynchronizer::createOrUpdateProduct
     */
    public function testCreateOrUpdateProduct_ProductNull()
    {
        $productResult = new Product();
        $productResult->setBackId(1);
        $productResult->setFrontId(2);

        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->setMethods(['persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();
        $productRepository->method('persistAndFlush')->with($productResult);

        $this->setProperty($this->productSynchronizer, 'productRepository', $productRepository);

        $productTest = $this->invokeMethod(
            $this->productSynchronizer,
            'createOrUpdateProduct',
            [null, 1, 2]
        );

        $this->assertEquals($productResult, $productTest);
    }

}