<?php

namespace App\Service\Synchronizer;

use App\Entity\Attribute;
use App\Entity\Back\ProductOptions as AttributeBack;
use App\Entity\Front\Attribute as AttributeFront;
use App\Entity\Front\AttributeDescription as AttributeDescriptionFront;
use App\Other\Fillers\AttributeDescriptionFiller;
use App\Other\Fillers\AttributeFiller;
use App\Other\Store;
use App\Repository\AttributeRepository;
use App\Repository\Back\ProductOptionsRepository as AttributeBackRepository;
use App\Repository\Front\AttributeDescriptionRepository as AttributeDescriptionFrontRepository;
use App\Repository\Front\AttributeRepository as AttributeFrontRepository;

class AttributeSynchronize
{
    private $store;
    private $attributeRepository;
    private $attributeFrontRepository;
    private $attributeDescriptionFrontRepository;
    private $attributeBackRepository;

    public function __construct(
        Store $store,
        AttributeRepository $attributeRepository,
        AttributeFrontRepository $attributeFrontRepository,
        AttributeDescriptionFrontRepository $attributeDescriptionFrontRepository,
        AttributeBackRepository $attributeBackRepository)
    {
        $this->store = $store;
        $this->attributeRepository = $attributeRepository;
        $this->attributeFrontRepository = $attributeFrontRepository;
        $this->attributeDescriptionFrontRepository = $attributeDescriptionFrontRepository;
        $this->attributeBackRepository = $attributeBackRepository;
    }

    public function clear()
    {
        $this->attributeFrontRepository->removeAll();
        $this->attributeDescriptionFrontRepository->removeAll();
        $this->attributeRepository->removeAll();
    }

    public function synchronize()
    {
        $attributes = $this->attributeBackRepository->findAll();
        foreach ($attributes as $attributeBack) {
            $attribute = $this->attributeRepository->findOneByBackId($attributeBack->getOptionId());
            if (null === $attribute) {
                $frontId = $this->createAttributeFrontFromBackProduct($attributeBack);
                $this->createAttributeFromBackAndFrontAttributeId($attributeBack->getOptionId(), $frontId);
            } else {
                $attributeFront = $this->attributeFrontRepository->find($attribute->getFrontId());
                if (null === $attribute) {
                    $frontId = $this->createAttributeFrontFromBackProduct($attributeBack);
                    $this->createAttributeFromBackAndFrontAttributeId($attributeBack->getOptionId(), $frontId);
                } else {
                    $this->updateAttributeFrontFromBackProduct($attributeBack, $attributeFront);
                    $this->attributeRepository->saveAndFlush($attribute);
                }
            }
        }
    }

    public function reload()
    {
        $this->clear();
        $this->synchronize();
    }

    protected function createAttributeFrontFromBackProduct(AttributeBack $attributeBack)
    {
        $attributeFront = new AttributeFront();
        AttributeFiller::backToFront($attributeFront, $this->store->getDefaultSortOrder(), $this->store->getDefaultAttributeGroupId());
        $this->attributeFrontRepository->saveAndFlush($attributeFront);

        $frontId = $attributeFront->getAttributeId();
        $languageId = $this->store->getDefaultLanguageId();
        $name = $attributeBack->getName();

        $attributeDescriptionFront = new AttributeDescriptionFront();
        AttributeDescriptionFiller::backToFront($attributeDescriptionFront, $frontId, $languageId, $name);
        $this->attributeDescriptionFrontRepository->saveAndFlush($attributeDescriptionFront);

        return $frontId;
    }

    /**
     * @param int $backId
     * @param int $frontId
     */
    protected function createAttributeFromBackAndFrontAttributeId(int $backId, int $frontId)
    {
        $attribute = new Attribute();
        $attribute->setBackId($backId);
        $attribute->setFrontId($frontId);
        $this->attributeRepository->saveAndFlush($attribute);
    }

    protected function updateAttributeFrontFromBackProduct(AttributeBack $attributeBack, AttributeFront $attributeFront)
    {
        AttributeFiller::backToFront($attributeFront, $this->store->getDefaultSortOrder(), $this->store->getDefaultAttributeGroupId());
        $this->attributeFrontRepository->saveAndFlush($attributeFront);
        $frontId = $attributeFront->getAttributeId();
        $attributeDescriptionFront = $this->attributeDescriptionFrontRepository->find($frontId);

        if (null === $attributeDescriptionFront) {
            $attributeDescriptionFront = new AttributeDescriptionFront();
        }
        $name = trim(mb_convert_encoding($attributeBack->getName(), 'utf-8', 'windows-1251'));
        AttributeDescriptionFiller::backToFront($attributeDescriptionFront, $frontId, $this->store->getDefaultLanguageId(), $name);
        $this->attributeDescriptionFrontRepository->saveAndFlush($attributeDescriptionFront);

        return $frontId;
    }
}