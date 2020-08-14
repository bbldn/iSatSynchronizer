<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\CategorySynchronizerInterface;
use App\Event\BackToFront\CategoriesClearEvent;
use App\Service\Synchronizer\BackToFront\Implementation\CategorySynchronizer as CategoryBaseSynchronizer;

class CategorySynchronizer extends CategoryBaseSynchronizer implements CategorySynchronizerInterface
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll(bool $synchronizeImage = false): void
    {
        $categoriesBack = $this->categoryBackRepository->findAll();
        foreach ($categoriesBack as $categoryBack) {
            $this->synchronizeCategory($categoryBack, $synchronizeImage);
        }
    }

    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void
    {
        $categoriesBack = $this->categoryBackRepository->findByIds($ids);
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

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeLast(bool $synchronizeImage = false): void
    {
        $categoryBack = $this->categoryBackRepository->findOneLast();
        if (null === $categoryBack) {
            return;
        }

        $this->synchronizeCategory($categoryBack, $synchronizeImage);
    }

    /**
     * @param bool $clearImage
     */
    public function clear(bool $clearImage = false): void
    {
        $this->categoryRepository->removeAll();

        $this->categoryFrontRepository->removeAll();
        $this->categoryDescriptionFrontRepository->removeAll();
        $this->categoryFilterFrontRepository->removeAll();
        $this->categoryPathFrontRepository->removeAll();
        $this->categoryLayoutFrontRepository->removeAll();
        $this->categoryStoreFrontRepository->removeAll();

        $this->categoryRepository->resetAutoIncrements();
        $this->categoryFrontRepository->resetAutoIncrements();

        $this->eventDispatcher->dispatch(new CategoriesClearEvent($clearImage));
    }

    /**
     * @param bool $synchronizeImage
     */
    public function reload(bool $synchronizeImage = false): void
    {
        $this->clear($synchronizeImage);
        $this->synchronizeAll($synchronizeImage);
    }
}