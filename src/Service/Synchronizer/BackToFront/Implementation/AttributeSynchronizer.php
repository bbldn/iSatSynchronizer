<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Attribute;
use App\Entity\Back\ProductOptions as AttributeBack;
use App\Entity\Front\Attribute as AttributeFront;
use App\Entity\Front\AttributeDescription as AttributeDescriptionFront;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\AttributeRepository;
use App\Repository\Back\ProductOptionsRepository as AttributeBackRepository;
use App\Repository\Front\AttributeDescriptionRepository as AttributeDescriptionFrontRepository;
use App\Repository\Front\AttributeRepository as AttributeFrontRepository;

class AttributeSynchronizer
{
    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var AttributeRepository $attributeRepository */
    protected $attributeRepository;

    /** @var AttributeFrontRepository $attributeFrontRepository */
    protected $attributeFrontRepository;

    /** @var AttributeDescriptionFrontRepository $attributeDescriptionFrontRepository */
    protected $attributeDescriptionFrontRepository;

    /** @var AttributeBackRepository $attributeBackRepository */
    protected $attributeBackRepository;

    /**
     * AttributeSynchronizer constructor.
     * @param StoreFront $storeFront
     * @param AttributeRepository $attributeRepository
     * @param AttributeFrontRepository $attributeFrontRepository
     * @param AttributeDescriptionFrontRepository $attributeDescriptionFrontRepository
     * @param AttributeBackRepository $attributeBackRepository
     */
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
    protected function clear(): void
    {
        $this->attributeRepository->removeAll();
        $this->attributeFrontRepository->removeAll();
        $this->attributeDescriptionFrontRepository->removeAll();

        $this->attributeRepository->resetAutoIncrements();
        $this->attributeFrontRepository->resetAutoIncrements();
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

    /**
     * @param AttributeBack $attributeBack
     * @param AttributeFront $attributeFront
     * @return AttributeFront
     */
    protected function updateAttributeFrontFromBackProduct(
        AttributeBack $attributeBack,
        AttributeFront $attributeFront
    ): AttributeFront
    {
        $attributeFront->setAttributeGroupId($this->storeFront->getDefaultAttributeGroupId());
        $attributeFront->setSortOrder($this->storeFront->getDefaultSortOrder());

        $this->attributeFrontRepository->persistAndFlush($attributeFront);

        $attributeDescriptionFront = $this->attributeDescriptionFrontRepository->find($attributeFront->getAttributeId());
        if (null === $attributeDescriptionFront) {
            $attributeDescriptionFront = new AttributeDescriptionFront();
        }

        $name = trim(Store::encodingConvert($attributeBack->getName()));
        $attributeDescriptionFront->setAttributeId($attributeFront->getAttributeId());
        $attributeDescriptionFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $attributeDescriptionFront->setName($name);

        $this->attributeDescriptionFrontRepository->persistAndFlush($attributeDescriptionFront);

        return $attributeFront;
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
        $this->attributeRepository->persistAndFlush($attribute);
    }
}