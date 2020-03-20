<?php

namespace App\Other\Fillers;

use App\Entity\Front\AttributeDescription as AttributeDescriptionFront;

class AttributeDescriptionFiller
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
        $name = trim(mb_convert_encoding($name, 'utf-8', 'windows-1251'));
        $attributeDescriptionFront->setName($name);

        return $attributeDescriptionFront;
    }
}