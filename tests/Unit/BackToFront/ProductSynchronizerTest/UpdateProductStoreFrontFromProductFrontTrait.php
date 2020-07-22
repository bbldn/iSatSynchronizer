<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ProductStoreRepository as ProductStoreFrontRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;

trait UpdateProductStoreFrontFromProductFrontTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     *
     */
    public function providerUpdateProductStoreFrontFromProductFront(): array
    {
        return [
            [new ProductStoreFront(1, 2), ['productId' => 1, 'storeId' => 2,]],
            [null, ['productId' => 3, 'storeId' => 4,]]
        ];
    }

    /**
     * @dataProvider providerUpdateProductStoreFrontFromProductFront
     * @param ProductStoreFront|null $productStoreFront
     * @param array $values
     */
    public function testUpdateProductStoreFrontFromProductFront(
        ?ProductStoreFront $productStoreFront,
        array $values
    ): void
    {
        $productFront = new ProductFront();
        $productFront->setProductId($values['productId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultStoreId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->expects($this->atMost(2))
            ->method('getDefaultStoreId')
            ->willReturn($values['storeId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productStoreFrontResult = new ProductStoreFront();
        $productStoreFrontResult->setProductId($values['productId']);
        $productStoreFrontResult->setStoreId($values['storeId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $productStoreFrontRepository = $this->getMockBuilder(ProductStoreFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndStoreId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productStoreFrontRepository
            ->expects($this->once())
            ->method('findOneByProductFrontIdAndStoreId')
            ->with($values['productId'], $values['storeId'])
            ->willReturn($productStoreFrontResult);

        /* @noinspection PhpUndefinedMethodInspection */
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

        if (null === $productStoreFront) {
            $this->assertEquals($productStoreFrontResult, $productCategoryFrontTest);
        } else {
            $this->assertSame($productStoreFrontResult, $productCategoryFrontTest);
        }
    }
}