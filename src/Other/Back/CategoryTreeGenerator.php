<?php

namespace App\Other\Back;

use App\Other\Back\Store as StoreBack;

class CategoryTreeGenerator
{
    public static function generate(array $categoriesBack): array
    {
        $ids = [];
        $result = [];

        foreach ($categoriesBack as $categoryBack) {
            $categoryId = $categoryBack->getId();

            $node = new \stdClass();
            $node->value = $categoryId;
            $node->label = StoreBack::encodingConvert($categoryBack->getName());

            $ids[$categoryId] = $node;

            $parentId = $categoryBack->getParent();
            if (true === key_exists($parentId, $ids)) {
                $tmp = $ids[$parentId];
                if (false === key_exists('children', $tmp)) {
                    $tmp->children = [];
                }
                $children = &$tmp->children;
            } else {
                $children = &$result;
            }

            $children[] = $node;
        }

        return $result;
    }
}