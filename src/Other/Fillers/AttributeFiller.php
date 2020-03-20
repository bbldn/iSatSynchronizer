<?php

namespace App\Other\Fillers;

use App\Entity\Front\Attribute as AttributeFront;

class AttributeFiller
{
    /**
     * @param AttributeFront $attributeFront
     * @param int $sortOrder
     * @param int $attributeGroupId
     * @return AttributeFront
     */
    public static function backToFront(AttributeFront $attributeFront, int $sortOrder, int $attributeGroupId)
    {
        $attributeFront->setSortOrder($sortOrder);
        $attributeFront->setAttributeGroupId($attributeGroupId);

        return $attributeFront;
    }
}