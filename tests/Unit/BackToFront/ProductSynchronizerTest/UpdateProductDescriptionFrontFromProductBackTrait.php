<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Entity\Front\Product as ProductFront;
use App\Helper\Front\Store as StoreFront;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;

trait UpdateProductDescriptionFrontFromProductBackTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    public function testUpdateProductDescriptionFrontFromProductBack(
        ?ProductFront $productFront,
        ?ProductDescriptionFront $productDescriptionFront,
        array $values
    ): void
    {
        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultLanguageId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->expects($this->once())
            ->method('getDefaultLanguageId')
            ->willReturn($values['defaultLanguageId']);

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->expects($this->once())
            ->method('getDefaultProductLayoutId')
            ->willReturn($values['defaultProductLayoutId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $this->setProperty(
            $this->productSynchronizer,
            'synchronizeImage',
            $values['synchronizeImage']
        );

    }
}