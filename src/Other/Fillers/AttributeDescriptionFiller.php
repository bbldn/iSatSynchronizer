<?php

namespace App\Other\Fillers;

use App\Entity\Front\AttributeDescription as AttributeDescriptionFront;
use App\Other\Store;

class AttributeDescriptionFiller extends Filler
{
    /**
     * @param AttributeDescriptionFront $attributeDescriptionFront
     * @param int $attributeId
     * @param int $languageId
     * @param string $name
     * @return AttributeDescriptionFront
     */
    public static function backToFront(AttributeDescriptionFront $attributeDescriptionFront, int $attributeId, int $languageId, string $name)
    {
        $attributeDescriptionFront->setAttributeId($attributeId);
        $attributeDescriptionFront->setLanguageId($languageId);
        $name = trim(Filler::securityString(Store::encodingConvert($name)));
        $attributeDescriptionFront->setName($name);

        return $attributeDescriptionFront;
    }
}