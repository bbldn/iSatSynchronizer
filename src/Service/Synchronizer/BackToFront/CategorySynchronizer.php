<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Category;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\CategoryDescription;
use App\Entity\Front\CategoryLayout;
use App\Entity\Front\CategoryPath as CategoryPathFront;
use App\Entity\Front\CategoryStore;
use App\Exception\CategoryBackNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Fillers\CategoryDescriptionFiller;
use App\Other\Fillers\CategoryFiller;
use App\Other\Fillers\CategoryLayoutFiller;
use App\Other\Fillers\CategoryPathFiller;
use App\Other\Fillers\CategoryStoreFiller;
use App\Other\Front\Store as StoreFront;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryDescriptionRepository as CategoryDescriptionFrontRepository;
use App\Repository\Front\CategoryFilterRepository as CategoryFilterFrontRepository;
use App\Repository\Front\CategoryLayoutRepository as CategoryLayoutFrontRepository;
use App\Repository\Front\CategoryPathRepository as CategoryPathFrontRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\CategoryStoreRepository as CategoryStoreFrontRepository;

class CategorySynchronizer
{
    private $storeFront;
    private $storeBack;
    private $categoryFrontRepository;
    private $categoryDescriptionFrontRepository;
    private $categoryFilterFrontRepository;
    private $categoryPathFrontRepository;
    private $categoryLayoutFrontRepository;
    private $categoryStoreFrontRepository;
    private $categoryRepository;
    private $categoryBackRepository;
    private $categoryImageSynchronizer;

    public function __construct(
        StoreFront $storeFront,
        StoreBack $storeBack,
        CategoryFrontRepository $categoryFrontRepository,
        CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository,
        CategoryFilterFrontRepository $categoryFilterFrontRepository,
        CategoryPathFrontRepository $categoryPathFrontRepository,
        CategoryLayoutFrontRepository $categoryLayoutFrontRepository,
        CategoryStoreFrontRepository $categoryStoreFrontRepository,
        CategoryRepository $categoryRepository,
        CategoryBackRepository $categoryBackRepository,
        CategoryImageSynchronizer $categoryImageSynchronizer
    )
    {
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->categoryDescriptionFrontRepository = $categoryDescriptionFrontRepository;
        $this->categoryFilterFrontRepository = $categoryFilterFrontRepository;
        $this->categoryPathFrontRepository = $categoryPathFrontRepository;
        $this->categoryLayoutFrontRepository = $categoryLayoutFrontRepository;
        $this->categoryStoreFrontRepository = $categoryStoreFrontRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryBackRepository = $categoryBackRepository;
        $this->categoryImageSynchronizer = $categoryImageSynchronizer;
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
     * @param bool $synchronizeImage
     */
    public function clear(bool $synchronizeImage = false): void
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

        if (true === $synchronizeImage) {
            $this->categoryImageSynchronizer->clearFolder();
        }
    }

    /**
     * @param int $id
     * @param bool $synchronizeImage
     * @throws CategoryBackNotFoundException
     */
    public function synchronizeOne(int $id, bool $synchronizeImage = false): void
    {
        $categoryBack = $this->categoryBackRepository->find($id);

        if (null === $categoryBack) {
            throw new CategoryBackNotFoundException();
        }

        $this->synchronizeCategory($categoryBack, $synchronizeImage);
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
     * @param CategoryBack $categoryBack
     * @param bool $synchronizeImage
     */
    protected function synchronizeCategory(CategoryBack $categoryBack, bool $synchronizeImage = false): void
    {
        $category = $this->categoryRepository->findOneByBackId($categoryBack->getCategoryId());
        $categoryFront = $this->getCategoryFrontFromCategory($category);
        $this->updateCategoryFrontFromCategoryBack($categoryBack, $categoryFront);
        $this->createOrUpdateCategory($category, $categoryBack->getCategoryId(), $categoryFront->getCategoryId());

        if (true === $synchronizeImage && null !== $categoryFront) {
            $this->synchronizeImage($categoryBack, $categoryFront);
        }
    }

    /**
     * @param Category $category
     * @param int $backId
     * @param int $frontId
     */
    protected function createOrUpdateCategory(?Category $category, int $backId, int $frontId): void
    {
        if (null === $category) {
            $category = new Category();
        }
        $category->setBackId($backId);
        $category->setFrontId($frontId);
        $this->categoryRepository->saveAndFlush($category);
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     * @return CategoryFront
     */
    protected function updateCategoryFrontFromCategoryBack(
        CategoryBack $categoryBack,
        CategoryFront $categoryFront
    ): CategoryFront
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = $this->storeFront->getDefaultCategoryFrontId();
        if (!in_array($parentBackId, $this->storeBack->getRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }
        CategoryFiller::backToFront($categoryBack, $categoryFront, $parentId);
        $this->categoryFrontRepository->saveAndFlush($categoryFront);

        $categoryFrontId = $categoryFront->getCategoryId();

        if ($this->storeFront->getDefaultCategoryFrontId() !== $parentId) {
            $categoryPath = $this->categoryPathFrontRepository->findByCategoryFrontIdAndPathId(
                $categoryFrontId,
                $parentId
            );

            if (null !== $categoryPath) {
                $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
            }
            $categoryPath = new CategoryPathFront();
            CategoryPathFiller::backToFront($categoryPath, $categoryFrontId, $parentId, 0);
            $this->categoryPathFrontRepository->saveAndFlush($categoryPath);
        }

        $categoryPath = $this->categoryPathFrontRepository->findByCategoryFrontIdAndPathId(
            $categoryFrontId,
            $categoryFrontId
        );

        if (null !== $categoryPath) {
            $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
        }
        $categoryPath = new CategoryPathFront();
        CategoryPathFiller::backToFront($categoryPath, $categoryFrontId, $categoryFrontId, 1);
        $this->categoryPathFrontRepository->saveAndFlush($categoryPath);


        $categoryDescription = $this->categoryDescriptionFrontRepository->find($categoryFrontId);
        if (null === $categoryDescription) {
            $categoryDescription = new CategoryDescription();
        }
        $languageId = $this->storeFront->getDefaultLanguageId();
        CategoryDescriptionFiller::backToFront($categoryBack, $categoryDescription, $categoryFrontId, $languageId);
        $this->categoryDescriptionFrontRepository->saveAndFlush($categoryDescription);

        $categoryLayout = $this->categoryLayoutFrontRepository->find($categoryFrontId);
        if (null === $categoryLayout) {
            $categoryLayout = new CategoryLayout();
        }
        $storeId = $this->storeFront->getDefaultStoreId();
        $layoutId = $this->storeFront->getDefaultLayoutId();
        CategoryLayoutFiller::backToFront($categoryLayout, $categoryFrontId, $storeId, $layoutId);
        $this->categoryLayoutFrontRepository->saveAndFlush($categoryLayout);

        $categoryStore = $this->categoryStoreFrontRepository->find($categoryFrontId);
        if (null === $categoryStore) {
            $categoryStore = new CategoryStore();
        }
        CategoryStoreFiller::backToFront($categoryStore, $categoryFrontId, $storeId);
        $this->categoryStoreFrontRepository->saveAndFlush($categoryStore);

        return $categoryFront;
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    protected function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront): void
    {
        $this->categoryImageSynchronizer->synchronizeImage($categoryBack, $categoryFront);
        $this->categoryFrontRepository->saveAndFlush($categoryFront);
    }

    /**
     * @param int $backId
     * @return int
     */
    protected function getParentFrontIdByBackId(int $backId): int
    {
        $category = $this->categoryRepository->findOneByBackId($backId);
        if (null === $category) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $front = $this->categoryFrontRepository->find($frontId);

        if (null === $front) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        return $front->getCategoryId();
    }

    /**
     * @param Category|null $category
     * @return CategoryFront
     */
    protected function getCategoryFrontFromCategory(?Category $category): CategoryFront
    {
        if (null === $category) {
            return new CategoryFront();
        }

        $categoryFront = $this->categoryFrontRepository->find($category->getFrontId());

        if (null === $categoryFront) {
            return new CategoryFront();
        }

        return $categoryFront;
    }
}