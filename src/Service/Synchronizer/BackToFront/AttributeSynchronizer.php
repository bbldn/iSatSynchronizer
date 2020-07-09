<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\AttributeSynchronizerContract;
use App\Service\Synchronizer\BackToFront\Implementation\AttributeSynchronizer as AttributeBaseSynchronizer;

class AttributeSynchronizer extends AttributeBaseSynchronizer implements AttributeSynchronizerContract
{
    /**
     *
     */
    public function synchronizeAll(): void
    {
        $attributesBack = $this->attributeBackRepository->findAll();
        foreach ($attributesBack as $attributeBack) {
            $this->synchronizeAttribute($attributeBack);
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeById(string $ids): void
    {
        $attributesBack = $this->attributeBackRepository->findByIds($ids);
        foreach ($attributesBack as $attributeBack) {
            $this->synchronizeAttribute($attributeBack);
        }
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
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }
}