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
        $productFront = new ProductFront($values['productId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultStoreId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->method('getDefaultStoreId')->willReturn($values['storeId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productStoreFrontResult = new ProductStoreFront($values['productId'], $values['storeId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $productStoreFrontRepository = $this->getMockBuilder(ProductStoreFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndStoreId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productStoreFrontRepository->method('findOneByProductFrontIdAndStoreId')->willReturn($productStoreFrontResult);

        /* @noinspection PhpUndefinedMethodInspection */
        $productStoreFrontRepository->method('persistAndFlush');

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