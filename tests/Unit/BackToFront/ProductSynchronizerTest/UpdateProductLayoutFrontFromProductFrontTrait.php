<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ProductLayoutRepository as ProductLayoutFrontRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;

trait UpdateProductLayoutFrontFromProductFrontTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     * @return array
     */
    public function providerUpdateProductLayoutFrontFromProductFront(): array
    {
        return [
            [
                new ProductLayoutFront(1, 2, 3),
                [
                    'productId' => 1,
                    'defaultStoreId' => 2,
                    'defaultProductLayoutId' => 3,
                ]
            ],
            [
                null,
                [
                    'productId' => 4,
                    'defaultStoreId' => 5,
                    'defaultProductLayoutId' => 6,
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerUpdateProductLayoutFrontFromProductFront
     * @param ProductLayoutFront|null $productLayoutFront
     * @param array $values
     */
    public function testUpdateProductLayoutFrontFromProductFront(
        ?ProductLayoutFront $productLayoutFront,
        array $values
    ): void
    {
        /* @noinspection PhpUndefinedMethodInspection */
        $productLayoutFrontRepository = $this->getMockBuilder(ProductLayoutFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndStoreId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productLayoutFrontRepository->method('findOneByProductFrontIdAndStoreId')->willReturn($productLayoutFront);

        /* @noinspection PhpUndefinedMethodInspection */
        $productLayoutFrontRepository->method('persistAndFlush');

        $this->setProperty(
            $this->productSynchronizer,
            'productLayoutFrontRepository',
            $productLayoutFrontRepository
        );

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultStoreId', 'getDefaultProductLayoutId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->method('getDefaultStoreId')->willReturn($values['defaultStoreId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->method('getDefaultProductLayoutId')->willReturn($values['defaultProductLayoutId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productFront = new ProductFront($values['productId']);

        $productLayoutFrontTest = $this->invokeMethod(
            $this->productSynchronizer,
            'updateProductLayoutFrontFromProductFront',
            [$productFront]
        );

        if (null !== $productLayoutFront) {
            $this->assertSame($productLayoutFront, $productLayoutFrontTest);
        }

        $productLayoutFront = new ProductLayoutFront(
            $values['productId'],
            $values['defaultStoreId'],
            $values['defaultProductLayoutId']
        );

        $this->assertEquals($productLayoutFront, $productLayoutFrontTest);
    }
}