<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Attribute;
use App\Entity\Back\ProductOptions as AttributeBack;
use App\Entity\Front\Attribute as AttributeFront;
use App\Entity\Front\AttributeDescription as AttributeDescriptionFront;
use App\Other\Fillers\AttributeDescriptionFiller;
use App\Other\Fillers\AttributeFiller;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\AttributeRepository;
use App\Repository\Back\ProductOptionsRepository as AttributeBackRepository;
use App\Repository\Front\AttributeDescriptionRepository as AttributeDescriptionFrontRepository;
use App\Repository\Front\AttributeRepository as AttributeFrontRepository;

class AttributeSynchronizer
{
    private $storeFront;
    private $attributeRepository;
    private $attributeFrontRepository;
    private $attributeDescriptionFrontRepository;
    private $attributeBackRepository;

    public function __construct(
        StoreFront $storeFront,
        AttributeRepository $attributeRepository,
        AttributeFrontRepository $attributeFrontRepository,
        AttributeDescriptionFrontRepository $attributeDescriptionFrontRepository,
        AttributeBackRepository $attributeBackRepository
    )
    {
        $this->storeFront = $storeFront;
        $this->attributeRepository = $attributeRepository;
        $this->attributeFrontRepository = $attributeFrontRepository;
        $this->attributeDescriptionFrontRepository = $attributeDescriptionFrontRepository;
        $this->attributeBackRepository = $attributeBackRepository;
    }

    /**
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->attributeRepository->removeAll();
        $this->attributeFrontRepository->removeAll();
        $this->attributeDescriptionFrontRepository->removeAll();

        $this->attributeRepository->resetAutoIncrements();
        $this->attributeFrontRepository->resetAutoIncrements();
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $attributes = $this->attributeBackRepository->findAll();
        foreach ($attributes as $attributeBack) {
            $this->synchronizeAttribute($attributeBack);
        }
    }

    /**
     * @param AttributeBack $attributeBack
     */
    protected function synchronizeAttribute(AttributeBack $attributeBack)
    {
        $attribute = $this->attributeRepository->findOneByBackId($attributeBack->getOptionId());
        $attributeFront = $this->getAttributeFrontFromAttribute($attribute);
        $this->updateAttributeFrontFromBackProduct($attributeBack, $attributeFront);
        $this->createOrUpdateAttribute($attribute, $attributeBack->getOptionId(), $attributeFront->getAttributeId());
    }

    /**
     * @param Attribute|null $attribute
     * @param int $backId
     * @param int $frontId
     */
    protected function createOrUpdateAttribute(?Attribute $attribute, int $backId, int $frontId): void
    {
        if (null === $attribute) {
            $attribute = new Attribute();
        }
        $attribute->setBackId($backId);
        $attribute->setFrontId($frontId);
        $this->attributeRepository->saveAndFlush($attribute);
    }

    protected function updateAttributeFrontFromBackProduct(
        AttributeBack $attributeBack,
        AttributeFront $attributeFront
    ): AttributeFront
    {
        AttributeFiller::backToFront(
            $attributeFront,
            $this->storeFront->getDefaultSortOrder(),
            $this->storeFront->getDefaultAttributeGroupId()
        );
        $this->attributeFrontRepository->saveAndFlush($attributeFront);
        $frontId = $attributeFront->getAttributeId();
        $attributeDescriptionFront = $this->attributeDescriptionFrontRepository->find($frontId);

        if (null === $attributeDescriptionFront) {
            $attributeDescriptionFront = new AttributeDescriptionFront();
        }

        $name = trim(Store::encodingConvert($attributeBack->getName()));
        AttributeDescriptionFiller::backToFront(
            $attributeDescriptionFront,
            $frontId,
            $this->storeFront->getDefaultLanguageId(),
            $name
        );
        $this->attributeDescriptionFrontRepository->saveAndFlush($attributeDescriptionFront);

        return $attributeFront;
    }

    protected function getAttributeFrontFromAttribute(?Attribute $attribute): AttributeFront
    {
        if (null === $attribute) {
            return new AttributeFront();
        }

        $attributeFront = $this->attributeFrontRepository->find($attribute->getFrontId());

        if (null === $attributeFront) {
            return new AttributeFront();
        }

        return $attributeFront;
    }
}