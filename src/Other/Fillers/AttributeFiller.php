<?php

namespace App\Other\Fillers;

use App\Entity\Front\Attribute as AttributeFront;

class AttributeFiller
{
    public static function backToFront(AttributeFront $attributeFront, int $sortOrder, int $attributeGroupId)
    {
        $attributeFront->setSortOrder($sortOrder);
        $attributeFront->setAttributeGroupId($attributeGroupId);
    }
}