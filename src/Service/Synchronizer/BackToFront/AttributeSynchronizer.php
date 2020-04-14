<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\AttributeSynchronizer as AttributeBaseSynchronizer;

class AttributeSynchronizer extends AttributeBaseSynchronizer
{
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
    public function synchronizeAll(): void
    {
        $attributesBack = $this->attributeBackRepository->findAll();
        foreach ($attributesBack as $attributeBack) {
            $this->synchronizeAttribute($attributeBack);
        }
    }

    public function clear(): void
    {
        parent::clear();
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