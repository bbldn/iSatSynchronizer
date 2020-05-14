<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Category;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\CategoryDescription;
use App\Entity\Front\CategoryLayout;
use App\Entity\Front\CategoryPath as CategoryPathFront;
use App\Entity\Front\CategoryStore;
use App\Entity\Front\SeoUrl as SeoUrlFront;
use App\Other\Back\Store as StoreBack;
use App\Other\Filler;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryDescriptionRepository as CategoryDescriptionFrontRepository;
use App\Repository\Front\CategoryFilterRepository as CategoryFilterFrontRepository;
use App\Repository\Front\CategoryLayoutRepository as CategoryLayoutFrontRepository;
use App\Repository\Front\CategoryPathRepository as CategoryPathFrontRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\CategoryStoreRepository as CategoryStoreFrontRepository;
use App\Repository\Front\SeoUrlRepository as SeoUrlFrontRepository;

class CategorySynchronizer
{
    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /** @var CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository */
    protected $categoryDescriptionFrontRepository;

    /** @var CategoryFilterFrontRepository $categoryFilterFrontRepository */
    protected $categoryFilterFrontRepository;

    /** @var CategoryPathFrontRepository $categoryPathFrontRepository */
    protected $categoryPathFrontRepository;

    /** @var CategoryLayoutFrontRepository $categoryLayoutFrontRepository */
    protected $categoryLayoutFrontRepository;

    /** @var CategoryStoreFrontRepository $categoryStoreFrontRepository */
    protected $categoryStoreFrontRepository;

    /** @var CategoryRepository $categoryRepository */
    protected $categoryRepository;

    /** @var CategoryBackRepository $categoryBackRepository */
    protected $categoryBackRepository;

    /** @var CategoryImageSynchronizer $categoryImageSynchronizer */
    protected $categoryImageSynchronizer;

    /** @var SeoUrlFrontRepository $seoUrlFrontRepository */
    protected $seoUrlFrontRepository;

    /** @var bool $seoProEnabled */
    protected $seoProEnabled;

    /**
     * CategorySynchronizer constructor.
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository
     * @param CategoryFilterFrontRepository $categoryFilterFrontRepository
     * @param CategoryPathFrontRepository $categoryPathFrontRepository
     * @param CategoryLayoutFrontRepository $categoryLayoutFrontRepository
     * @param CategoryStoreFrontRepository $categoryStoreFrontRepository
     * @param CategoryRepository $categoryRepository
     * @param CategoryBackRepository $categoryBackRepository
     * @param CategoryImageSynchronizer $categoryImageSynchronizer
     * @param SeoUrlFrontRepository $seoUrlFrontRepository
     * @param bool $seoProEnabled
     */
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
        CategoryImageSynchronizer $categoryImageSynchronizer,
        SeoUrlFrontRepository $seoUrlFrontRepository,
        bool $seoProEnabled
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
        $this->seoUrlFrontRepository = $seoUrlFrontRepository;
        $this->seoProEnabled = $seoProEnabled;
    }

    /**
     * @param bool $synchronizeImage
     */
    protected function clear(bool $synchronizeImage = false): void
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

        if (true === $this->seoProEnabled) {
            $this->seoUrlFrontRepository->removeAllByQuery('category_id');
        }

        if (true === $synchronizeImage) {
            $this->categoryImageSynchronizer->clearFolder();
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

        $categoryFront->fill(
            Filler::securityString(null),
            $parentId,
            0,
            1,
            0,
            $categoryBack->getEnabled()
        );

        $this->categoryFrontRepository->persistAndFlush($categoryFront);

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
            $categoryPath->fill(
                $categoryFrontId,
                $parentId,
                0
            );
            $this->categoryPathFrontRepository->persistAndFlush($categoryPath);
        }

        $categoryPath = $this->categoryPathFrontRepository->findByCategoryFrontIdAndPathId(
            $categoryFrontId,
            $categoryFrontId
        );

        if (null !== $categoryPath) {
            $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
        }
        $categoryPath = new CategoryPathFront();
        $categoryPath->fill(
            $categoryFrontId,
            $categoryFrontId,
            1
        );
        $this->categoryPathFrontRepository->persistAndFlush($categoryPath);

        $categoryDescription = $this->categoryDescriptionFrontRepository->find($categoryFrontId);
        if (null === $categoryDescription) {
            $categoryDescription = new CategoryDescription();
        }

        $categoryDescription->fill(
            $categoryFrontId,
            $this->storeFront->getDefaultLanguageId(),
            Filler::securityString(Store::encodingConvert($categoryBack->getName())),
            Filler::securityString(Store::encodingConvert($categoryBack->getDescription())),
            Filler::securityString(Store::encodingConvert($categoryBack->getName())),
            Filler::securityString(null),
            Filler::securityString(null)
        );
        $this->categoryDescriptionFrontRepository->persistAndFlush($categoryDescription);

        $categoryLayout = $this->categoryLayoutFrontRepository->find($categoryFrontId);
        if (null === $categoryLayout) {
            $categoryLayout = new CategoryLayout();
        }

        $categoryLayout->fill(
            $categoryFrontId,
            $this->storeFront->getDefaultStoreId(),
            $this->storeFront->getDefaultLayoutId()
        );

        $this->categoryLayoutFrontRepository->persistAndFlush($categoryLayout);

        $categoryStore = $this->categoryStoreFrontRepository->find($categoryFrontId);
        if (null === $categoryStore) {
            $categoryStore = new CategoryStore();
        }

        $categoryStore->fill(
            $categoryFrontId,
            $this->storeFront->getDefaultStoreId()
        );

        $this->categoryStoreFrontRepository->persistAndFlush($categoryStore);

        if (false === $this->seoProEnabled) {
            return $categoryFront;
        }

        $categoryFrontId = $categoryFront->getCategoryId();
        $seoUrl = $this->seoUrlFrontRepository->findOneByQueryAndLanguageId(
            'category_id=' . $categoryFrontId,
            $this->storeFront->getDefaultLanguageId()
        );
        $this->synchronizeSeoUrl($seoUrl, $categoryFrontId, $categoryBack);

        return $categoryFront;
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
     * @param SeoUrlFront|null $seoUrl
     * @param int $categoryFrontId
     * @param CategoryBack $categoryBack
     */
    protected function synchronizeSeoUrl(?SeoUrlFront $seoUrl, int $categoryFrontId, CategoryBack $categoryBack): void
    {
        if (null === $seoUrl) {
            $seoUrl = new SeoUrlFront();
        }
        $seoUrl->fill(
            $this->storeFront->getDefaultStoreId(),
            $this->storeFront->getDefaultLanguageId(),
            'category_id=' . $categoryFrontId,
            StoreFront::generateURL($categoryBack->getCategoryId(), Store::encodingConvert($categoryBack->getName()))
        );

        $this->seoUrlFrontRepository->persistAndFlush($seoUrl);
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
        $this->categoryRepository->persistAndFlush($category);
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    protected function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront): void
    {
        $this->categoryImageSynchronizer->synchronizeImage($categoryBack, $categoryFront);
        $this->categoryFrontRepository->persistAndFlush($categoryFront);
    }
}