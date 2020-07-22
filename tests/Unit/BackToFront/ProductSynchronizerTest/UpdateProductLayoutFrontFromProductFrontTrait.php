<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ProductLayoutRepository as ProductLayoutFrontRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;

trait UpdateProductLayoutFrontFromProductFrontTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    public function testCreateOrUpdateProduct(): void
    {
        /* @noinspection PhpUndefinedMethodInspection */
        $productLayoutFrontRepository = $this->getMockBuilder(ProductLayoutFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndStoreId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productLayoutFrontRepository->expects($this->once())
            ->method('findOneByProductFrontIdAndStoreId')
            ->with(0, 0);

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultCategoryFrontId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->expects($this->once())
            ->method('getDefaultCategoryFrontId')
            ->willReturn($values['categoryFrontId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );
    }
}