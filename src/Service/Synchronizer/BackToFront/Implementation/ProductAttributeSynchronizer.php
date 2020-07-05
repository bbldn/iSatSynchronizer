<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Helper\Front\Store as StoreFront;
use App\Repository\AttributeRepository;
use App\Repository\Back\ProductOptionsValuesRepository as AttributeBackRepository;
use App\Repository\Front\ProductAttributeRepository as ProductAttributeFrontRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;

class ProductAttributeSynchronizer extends BackToFrontSynchronizer
{
    /** @var AttributeBackRepository $attributeBackRepository */
    protected $attributeBackRepository;

    /** @var AttributeRepository $attributeRepository */
    protected $attributeRepository;

    /** @var ProductAttributeFrontRepository $productAttributeFrontRepository */
    protected $productAttributeFrontRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * AttributeProductSynchronizer constructor.
     * @param AttributeBackRepository $attributeBackRepository
     * @param AttributeRepository $attributeRepository
     * @param ProductAttributeFrontRepository $productAttributeFrontRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        AttributeBackRepository $attributeBackRepository,
        AttributeRepository $attributeRepository,
        ProductAttributeFrontRepository $productAttributeFrontRepository,
        StoreFront $storeFront
    )
    {
        $this->attributeBackRepository = $attributeBackRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productAttributeFrontRepository = $productAttributeFrontRepository;
        $this->storeFront = $storeFront;
    }

    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    protected function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void
    {
        $productAttributesBack = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributesBack as $productAttributeBack) {
            $attribute = $this->attributeRepository->findOneByBackId($productAttributeBack->getOptionId());
            if (null === $attribute) {
                continue;
            }

            $productAttributeFront = $this->productAttributeFrontRepository->findOneByProductIdAttributeIdLanguageId(
                $productFrontId,
                $attribute->getFrontId(),
                $this->storeFront->getDefaultLanguageId()
            );

            if (null === $productAttributeFront) {
                $productAttributeFront = new ProductAttributeFront();
            }

            $productAttributeFront->setProductId($productFrontId);
            $productAttributeFront->setAttributeId($attribute->getFrontId());
            $productAttributeFront->setLanguageId($this->storeFront->getDefaultLanguageId());
            $productAttributeFront->setText(
                trim($productAttributeBack->getOptionValue())
            );

            $this->productAttributeFrontRepository->persistAndFlush($productAttributeFront);
        }
    }

    /**
     *
     */
    protected function clear(): void
    {
        $this->productAttributeFrontRepository->clear();
        $this->productAttributeFrontRepository->resetAutoIncrements();
    }
}