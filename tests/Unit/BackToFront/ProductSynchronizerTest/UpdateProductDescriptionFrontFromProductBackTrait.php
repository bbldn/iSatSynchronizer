<?php

namespace App\Tests\Unit\BackToFront\ProductSynchronizerTest;

use App\Contract\BackToFront\DescriptionHelperInterface;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;

trait UpdateProductDescriptionFrontFromProductBackTrait
{
    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     * @return array
     */
    public function providerUpdateProductDescriptionFrontFromProductBack(): array
    {
        return [
            [
                new ProductDescriptionFront(),
                [
                    'productFrontId' => 1,
                    'name' => 'name1',
                    'description' => 'description1',
                    'tags' => 'tags1',
                    'metaKeywords' => 'metaKeywords1',
                    'defaultLanguageId' => 1,
                    'synchronizeImage' => true,
                ],
            ],
        ];
    }

    /**
     * @param ProductDescriptionFront|null $productDescriptionFront
     * @param array $values
     */
    public function testUpdateProductDescriptionFrontFromProductBack(
        ?ProductDescriptionFront $productDescriptionFront,
        array $values
    ): void
    {
        /* @noinspection PhpUndefinedMethodInspection */
        $productDescriptionFrontRepository = $this->getMockBuilder(ProductDescriptionFrontRepository::class)
            ->setMethods(['findOneByProductFrontIdAndLanguageId', 'persistAndFlush'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $productDescriptionFrontRepository
            ->method('findOneByProductFrontIdAndLanguageId')
            ->willReturn($productDescriptionFront);

        /* @noinspection PhpUndefinedMethodInspection */
        $productDescriptionFrontRepository->method('persistAndFlush');

        $this->setProperty(
            $this->productSynchronizer,
            'productDescriptionFrontRepository',
            $productDescriptionFrontRepository
        );

        /* @noinspection PhpUndefinedMethodInspection */
        $descriptionHelper = $this->getMockBuilder(DescriptionHelperInterface::class)
            ->setMethods(['synchronize'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $descriptionHelper->method('synchronize')->willReturn($values['description']);

        $this->setProperty(
            $this->productSynchronizer,
            'descriptionHelper',
            $descriptionHelper
        );

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront = $this->getMockBuilder(StoreFront::class)
            ->setMethods(['getDefaultLanguageId'])
            ->disableOriginalConstructor()
            ->getMock();

        /* @noinspection PhpUndefinedMethodInspection */
        $storeFront->method('getDefaultLanguageId')->willReturn($values['defaultLanguageId']);

        $this->setProperty(
            $this->productSynchronizer,
            'storeFront',
            $storeFront
        );

        $productFront = new ProductFront($values['productFrontId']);
        $productBack = new ProductBack();
        $productBack->setName($values['name'])
            ->setDescription($values['description'])
            ->setMetaDescription($values['metaKeywords'])
            ->setTags($values['tags']);

        $productDescriptionFrontTest = $this->invokeMethod(
            $this->productSynchronizer,
            'updateProductDescriptionFrontFromProductBack',
            [$productBack, $productFront]
        );

        if (null !== $productDescriptionFront) {
            $this->assertSame($productDescriptionFront, $productDescriptionFrontTest);
        }

        $productDescriptionFront = new ProductDescriptionFront(
            $values['productFrontId'],
            $values['defaultLanguageId'],
            $values['name'],
            $values['description'],
            $values['tags'],
            '',
            '',
            $values['metaKeywords']
        );

        $this->assertEquals($productDescriptionFront, $productDescriptionFrontTest);
    }
}