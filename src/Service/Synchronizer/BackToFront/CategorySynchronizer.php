<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\CategorySynchronizer as CategoryBaseSynchronizer;

class CategorySynchronizer extends CategoryBaseSynchronizer
{
    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void
    {
        $this->urls = $this->getSeoUrlFromProducts();
        $categoriesBack = $this->categoryBackRepository->findByIds($ids);
        foreach ($categoriesBack as $categoryBack) {
            $this->synchronizeCategory($categoryBack, $synchronizeImage);
        }
    }

    /**
     * @param bool $synchronizeImage
     */
    public function reload(bool $synchronizeImage = false): void
    {
        $this->clear($synchronizeImage);
        $this->synchronizeAll($synchronizeImage);
    }

    /**
     * @param bool $clearImage
     */
    public function clear(bool $clearImage = false): void
    {
        parent::clear($clearImage);
    }

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll(bool $synchronizeImage = false): void
    {
        $this->urls = $this->getSeoUrlFromProducts();
        $categoriesBack = $this->categoryBackRepository->findAll();
        foreach ($categoriesBack as $categoryBack) {
            $this->synchronizeCategory($categoryBack, $synchronizeImage);
        }
    }

    /**
     * @param string $name
     * @param bool $synchronizeImage
     */
    public function synchronizeByName(string $name, bool $synchronizeImage = false): void
    {
        $categoriesBack = $this->categoryBackRepository->findByName($name);
        foreach ($categoriesBack as $categoryBack) {
            $this->synchronizeCategory($categoryBack, $synchronizeImage);
        }
    }
}