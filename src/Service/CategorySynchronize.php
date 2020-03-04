<?php

namespace App\Service;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Category as Category;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\CategoryDescription;
use App\Entity\Front\CategoryLayout;
use App\Entity\Front\CategoryStore;
use App\Other\Fillers\CategoryDescriptionFiller;
use App\Other\Fillers\CategoryFiller;
use App\Other\Fillers\CategoryLayoutFiller;
use App\Other\Fillers\CategoryStoreFiller;
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

    public function synchronize()
    {
        $categoriesBack = $this->categoryRepositoryBack->findAll();
        foreach ($categoriesBack as $categoryBack) {
            $category = $this->categoryRepository->findOneByBackId($categoryBack->getCategoryId());
            if ($category === null) {
                $frontId = $this->createCategoryFrontFromBackCategory($categoryBack);
                $this->createCategoryFromBackAndFrontCategoryId($categoryBack->getCategoryId(), $frontId);
            } else {
                $categoryFront = $this->categoryRepositoryFront->find($category->getFrontId());
                if ($categoryFront === null) {
                    $this->updateCategoryFrontFromBackCategory($categoryBack, $categoryFront);
                } else {
                    $this->categoryRepository->remove($category);
                    $frontId = $this->createCategoryFrontFromBackCategory($categoryBack);
                    $this->createCategoryFromBackAndFrontCategoryId($categoryBack->getCategoryId(), $frontId);
                }
            }
        }
    }

    protected function createCategoryFrontFromBackCategory(CategoryBack $categoryBack)
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = 0;

        if (!in_array($parentBackId, $this->getRootCategoryId())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }

        $categoryFront = new CategoryFront();
        CategoryFiller::backToFront($categoryBack, $categoryFront, $parentId);
        $this->categoryRepositoryFront->saveAndFlush($categoryFront);

        $categoryFrontId = $categoryFront->getCategoryId();

        $categoryDescriptionFront = new CategoryDescription();
        $languageId = $this->getDefaultLanguageId();
        CategoryDescriptionFiller::backToFront($categoryBack, $categoryDescriptionFront, $categoryFrontId, $languageId);
        $this->categoryDescriptionRepositoryFront->saveAndFlush($categoryDescriptionFront);

        $categoryLayout = new CategoryLayout();
        $storeId = $this->getStoreId();
        $layoutId = $this->getLayoutId();
        CategoryLayoutFiller::backToFront($categoryLayout, $categoryFrontId, $storeId, $layoutId);
        $this->categoryLayoutRepositoryFront->saveAndFlush($categoryLayout);

        $categoryStore = new CategoryStore();
        CategoryStoreFiller::backToFront($categoryStore, $categoryFrontId, $storeId);
        $this->categoryStoreRepositoryFront->saveAndFlush($categoryStore);

        return $categoryFrontId;
    }

    protected function updateCategoryFrontFromBackCategory(CategoryBack $categoryBack, CategoryFront $categoryFront)
    {

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
        $back = $this->categoryRepository->findOneByBackId($backId);
        if ($back === null) {
            //@TODO Notify
            return 0;
        }

        $frontId = $back->getFrontId();
        if ($frontId === null) {
            //@TODO Notify
            return 0;
        }

        $front = $this->categoryRepositoryFront->find($frontId);

        if ($front === null) {
            //@TODO Notify
            return 0;
        }

        return $front->getCategoryId();
    }

    protected function getDefaultLanguageId()
    {
        return 3;
    }

    protected function getStoreId()
    {
        return 0;
    }

    protected function getLayoutId()
    {
        return 0;
    }

    protected function getRootCategoryId()
    {
        return [0, 1];
    }
}