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
use Exception;

trait UpdateProductCategoryFrontFromProductBackTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     * @return array
     */
    public function providerUpdateProductCategoryFrontFromProductBack(): array
    {
        return [
            [
                new CategoryFront(1),
                new ProductCategoryFront(2, 1),
                [
                    'productFrontId' => 2,
                    'categoryFrontId' => 1,
                ]
            ],
            [
                null,
                new ProductCategoryFront(4, 3),
                [
                    'productFrontId' => 4,
                    'categoryFrontId' => 3,
                ]
            ],
            [
                new CategoryFront(5),
                null,
                [
                    'productFrontId' => 6,
                    'categoryFrontId' => 5,
                ]
            ],
            [
                null,
                null,
                [
                    'productFrontId' => 8,
                    'categoryFrontId' => 7,
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerUpdateProductCategoryFrontFromProductBack
     * @see          ProductSynchronizer::updateProductCategoryFrontFromProductBack
     * @param CategoryFront|null $categoryFront
     * @param ProductCategoryFront|null $productCategoryFront
     * @param array $values
     * @throws Exception
     */
    public function testUpdateProductCategoryFrontFromProductBack(
        ?CategoryFront $categoryFront,
        ?ProductCategoryFront $productCategoryFront,
        array $values
    ): void
    {
        $productBack = new ProductBack(null, random_int(10, 40));
        $productFront = new ProductFront($values['productFrontId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $productSynchronizerHelper = $this->getMockBuilder(ProductSynchronizerHelper::class)
            ->setMethods(['getCategoryFrontByCategoryBackId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productSynchronizerHelper->method('getCategoryFrontByCategoryBackId')
            ->with($productBack->getCategoryId())
            ->willReturn($categoryFront);

        $this->setProperty(
            $this->productSynchronizer,
            'productSynchronizerHelper',
            $productSynchronizerHelper
        );

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultCategoryFrontId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->method('getDefaultCategoryFrontId')
            ->willReturn($values['categoryFrontId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        /* @noinspection PhpUndefinedMethodInspection */
        $productCategoryFrontRepository = $this->getMockBuilder(ProductCategoryFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndCategoryId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productCategoryFrontRepository->method('findOneByProductFrontIdAndCategoryId')
            ->with($values['productFrontId'], $values['categoryFrontId'])
            ->willReturn($productCategoryFront);

        /* @noinspection PhpUndefinedMethodInspection */
        $productCategoryFrontRepository->method('persistAndFlush')
            ->with(new ProductCategoryFront($values['productFrontId'], $values['categoryFrontId']));

        $this->setProperty(
            $this->productSynchronizer,
            'productCategoryFrontRepository',
            $productCategoryFrontRepository
        );

        $productCategoryFrontTest = $this->invokeMethod(
            $this->productSynchronizer,
            'updateProductCategoryFrontFromProductBack',
            [$productBack, $productFront]
        );

        if (null === $productCategoryFront) {
            $productCategoryFront = new ProductCategoryFront($values['productFrontId'], $values['categoryFrontId']);
            $this->assertEquals($productCategoryFront, $productCategoryFrontTest);
        } else {
            $this->assertSame($productCategoryFront, $productCategoryFrontTest);
        }
    }
}