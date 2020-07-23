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
    public function providerCreateOrUpdateProduct(): array
    {
        $productResult = new Product(0, 2, 1);

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
    public function testCreateOrUpdateProduct(?Product $productInput, Product $productResult): void
    {
        /* @noinspection PhpUndefinedMethodInspection */
        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->setMethods(['persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productRepository->method('persistAndFlush')->with($productResult);

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