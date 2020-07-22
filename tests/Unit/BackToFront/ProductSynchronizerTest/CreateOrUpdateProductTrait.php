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
     * @return array
     */
    public function providerCreateOrUpdateProduct()
    {
        $productResult = new Product();
        $productResult->setBackId(1);
        $productResult->setFrontId(2);

        return [
            [null, $productResult],
            [$productResult, $productResult],
        ];
    }

    /**
     * @see          ProductSynchronizer::createOrUpdateProduct
     * @dataProvider providerCreateOrUpdateProduct
     * @param Product|null $productInput
     * @param Product $productResult
     */
    public function testCreateOrUpdateProduct(?Product $productInput, Product $productResult)
    {
        /* @noinspection PhpUndefinedMethodInspection */
        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->setMethods(['persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productRepository->expects($this->once())->method('persistAndFlush')->with($productResult);

        $this->setProperty($this->productSynchronizer, 'productRepository', $productRepository);

        $productTest = $this->invokeMethod(
            $this->productSynchronizer,
            'createOrUpdateProduct',
            [$productInput, 1, 2]
        );

        if (null === $productInput) {
            $this->assertEquals($productResult, $productTest);
        } else {
            $this->assertSame($productResult, $productTest);
        }
    }
}