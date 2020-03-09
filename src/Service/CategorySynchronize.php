<?php

namespace App\Service;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Category;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\CategoryDescription;
use App\Entity\Front\CategoryLayout;
use App\Entity\Front\CategoryStore;
use App\Other\Fillers\CategoryDescriptionFiller;
use App\Other\Fillers\CategoryFiller;
use App\Other\Fillers\CategoryLayoutFiller;
use App\Other\Fillers\CategoryStoreFiller;
use App\Other\Store;
use App\Repository\Back\CategoryRepository as CategoryRepositoryBack;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryDescriptionRepository as CategoryDescriptionRepositoryFront;
use App\Repository\Front\CategoryLayoutRepository as CategoryLayoutRepositoryFront;
use App\Repository\Front\CategoryRepository as CategoryRepositoryFront;
use App\Repository\Front\CategoryStoreRepository as CategoryStoreRepositoryFront;

class CategorySynchronize
{
    private $categoryRepositoryBack;
    private $categoryRepositoryFront;
    private $categoryDescriptionRepositoryFront;
    private $categoryLayoutRepositoryFront;
    private $categoryStoreRepositoryFront;
    private $categoryRepository;

    public function __construct(CategoryRepositoryBack $categoryRepositoryBack,
                                CategoryRepositoryFront $categoryRepositoryFront,
                                CategoryDescriptionRepositoryFront $categoryDescriptionRepositoryFront,
                                CategoryLayoutRepositoryFront $categoryLayoutRepositoryFront,
                                CategoryStoreRepositoryFront $categoryStoreRepositoryFront,
                                CategoryRepository $categoryRepository)
    {
        $this->categoryRepositoryBack = $categoryRepositoryBack;
        $this->categoryRepositoryFront = $categoryRepositoryFront;
        $this->categoryDescriptionRepositoryFront = $categoryDescriptionRepositoryFront;
        $this->categoryLayoutRepositoryFront = $categoryLayoutRepositoryFront;
        $this->categoryStoreRepositoryFront = $categoryStoreRepositoryFront;
        $this->categoryRepository = $categoryRepository;
    }

    public function synchronize($synchronizeImage = false)
    {
        $categoriesBack = $this->categoryRepositoryBack->findAll();
        foreach ($categoriesBack as $categoryBack) {
            $category = $this->categoryRepository->findOneByBackId($categoryBack->getCategoryId());
            if (null === $category) {
                $frontId = $this->createCategoryFrontFromBackCategory($categoryBack);
                $this->createCategoryFromBackAndFrontCategoryId($categoryBack->getCategoryId(), $frontId);
            } else {
                $categoryFront = $this->categoryRepositoryFront->find($category->getFrontId());
                if (null === $categoryFront) {
                    $this->categoryRepository->remove($category);
                    $frontId = $this->createCategoryFrontFromBackCategory($categoryBack);
                    $this->createCategoryFromBackAndFrontCategoryId($categoryBack->getCategoryId(), $frontId);
                } else {
                    $this->updateCategoryFrontFromBackCategory($categoryBack, $categoryFront);
                    $this->categoryRepository->saveAndFlush($category);
                }
            }
        }
    }

    protected function createCategoryFrontFromBackCategory(CategoryBack $categoryBack)
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = Store::getDefaultCategoryFrontId();

        if (!in_array($parentBackId, Store::getRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }

        $categoryFront = new CategoryFront();
        CategoryFiller::backToFront($categoryBack, $categoryFront, $parentId);
        $this->categoryRepositoryFront->saveAndFlush($categoryFront);

        $categoryFrontId = $categoryFront->getCategoryId();

        $categoryDescription = new CategoryDescription();
        $languageId = Store::getDefaultLanguageId();
        CategoryDescriptionFiller::backToFront($categoryBack, $categoryDescription, $categoryFrontId, $languageId);
        $this->categoryDescriptionRepositoryFront->saveAndFlush($categoryDescription);

        $categoryLayout = new CategoryLayout();
        $storeId = Store::getDefaultStoreId();
        $layoutId = Store::getDefaultLayoutId();
        CategoryLayoutFiller::backToFront($categoryLayout, $categoryFrontId, $storeId, $layoutId);
        $this->categoryLayoutRepositoryFront->saveAndFlush($categoryLayout);

        $categoryStore = new CategoryStore();
        CategoryStoreFiller::backToFront($categoryStore, $categoryFrontId, $storeId);
        $this->categoryStoreRepositoryFront->saveAndFlush($categoryStore);

        return $categoryFrontId;
    }

    protected function updateCategoryFrontFromBackCategory(CategoryBack $categoryBack, CategoryFront $categoryFront)
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = Store::getDefaultCategoryFrontId();
        if (!in_array($parentBackId, Store::getRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }
        CategoryFiller::backToFront($categoryBack, $categoryFront, $parentId);
        $this->categoryRepositoryFront->saveAndFlush($categoryFront);

        $categoryFrontId = $categoryFront->getCategoryId();
        $categoryDescription = $this->categoryDescriptionRepositoryFront->find($categoryFrontId);
        if (null === $categoryDescription) {
            $categoryDescription = new CategoryDescription();
        }
        $languageId = Store::getDefaultLanguageId();
        CategoryDescriptionFiller::backToFront($categoryBack, $categoryDescription, $categoryFrontId, $languageId);
        $this->categoryDescriptionRepositoryFront->saveAndFlush($categoryDescription);

        $categoryLayout = $this->categoryLayoutRepositoryFront->find($categoryFrontId);
        if (null === $categoryLayout) {
            $categoryLayout = new CategoryLayout();
        }
        $storeId = Store::getDefaultStoreId();
        $layoutId = Store::getDefaultLayoutId();
        CategoryLayoutFiller::backToFront($categoryLayout, $categoryFrontId, $storeId, $layoutId);
        $this->categoryLayoutRepositoryFront->saveAndFlush($categoryLayout);

        $categoryStore = $this->categoryStoreRepositoryFront->find($categoryFrontId);
        if (null === $categoryStore) {
            $categoryStore = new CategoryStore();
        }
        CategoryStoreFiller::backToFront($categoryStore, $categoryFrontId, $storeId);
        $this->categoryStoreRepositoryFront->saveAndFlush($categoryStore);

        return $categoryFrontId;
    }

    protected function createCategoryFromBackAndFrontCategoryId(int $backId, int $frontId)
    {
        $category = new Category();
        $category->setBackId($backId);
        $category->setFrontId($frontId);
        $this->categoryRepository->saveAndFlush($category);
    }

    protected function getParentFrontIdByBackId(int $backId)
    {
        $category = $this->categoryRepository->findOneByBackId($backId);
        if (null === $category) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        $front = $this->categoryRepositoryFront->find($frontId);

        if (null === $front) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        return $front->getCategoryId();
    }
}