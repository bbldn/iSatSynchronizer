<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Contract\BackToFront\CategorySynchronizerHelperContract;
use App\Entity\Back\Category as CategoryBack;
use App\Entity\Category;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\CategoryDescription as CategoryDescriptionFront;
use App\Entity\Front\CategoryLayout as CategoryLayoutFront;
use App\Entity\Front\CategoryPath as CategoryPathFront;
use App\Entity\Front\CategoryStore as CategoryStoreFront;
use App\Event\BackToFront\CategorySynchronizedEvent;
use App\Helper\Back\Store as StoreBack;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryDescriptionRepository as CategoryDescriptionFrontRepository;
use App\Repository\Front\CategoryFilterRepository as CategoryFilterFrontRepository;
use App\Repository\Front\CategoryLayoutRepository as CategoryLayoutFrontRepository;
use App\Repository\Front\CategoryPathRepository as CategoryPathFrontRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\CategoryStoreRepository as CategoryStoreFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

abstract class CategorySynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var EventDispatcherInterface $eventDispatcher */
    protected $eventDispatcher;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var CategorySynchronizerHelperContract $categorySynchronizerHelper */
    protected $categorySynchronizerHelper;

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

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var string|null $defaultImagePath */
    protected $defaultImagePath = null;

    /**
     * CategorySynchronizer constructor.
     * @param LoggerInterface $logger
     * @param EventDispatcherInterface $eventDispatcher
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param CategorySynchronizerHelperContract $categorySynchronizerHelper
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository
     * @param CategoryFilterFrontRepository $categoryFilterFrontRepository
     * @param CategoryPathFrontRepository $categoryPathFrontRepository
     * @param CategoryLayoutFrontRepository $categoryLayoutFrontRepository
     * @param CategoryStoreFrontRepository $categoryStoreFrontRepository
     * @param CategoryRepository $categoryRepository
     * @param CategoryBackRepository $categoryBackRepository
     * @param ProductBackRepository $productBackRepository
     */
    public function __construct(
        LoggerInterface $logger,
        EventDispatcherInterface $eventDispatcher,
        StoreFront $storeFront,
        StoreBack $storeBack,
        CategorySynchronizerHelperContract $categorySynchronizerHelper,
        CategoryFrontRepository $categoryFrontRepository,
        CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository,
        CategoryFilterFrontRepository $categoryFilterFrontRepository,
        CategoryPathFrontRepository $categoryPathFrontRepository,
        CategoryLayoutFrontRepository $categoryLayoutFrontRepository,
        CategoryStoreFrontRepository $categoryStoreFrontRepository,
        CategoryRepository $categoryRepository,
        CategoryBackRepository $categoryBackRepository,
        ProductBackRepository $productBackRepository
    )
    {
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->categorySynchronizerHelper = $categorySynchronizerHelper;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->categoryDescriptionFrontRepository = $categoryDescriptionFrontRepository;
        $this->categoryFilterFrontRepository = $categoryFilterFrontRepository;
        $this->categoryPathFrontRepository = $categoryPathFrontRepository;
        $this->categoryLayoutFrontRepository = $categoryLayoutFrontRepository;
        $this->categoryStoreFrontRepository = $categoryStoreFrontRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryBackRepository = $categoryBackRepository;
        $this->productBackRepository = $productBackRepository;
    }

    /**
     * @param CategoryBack $categoryBack
     * @param bool $synchronizeImage
     */
    protected function synchronizeCategory(CategoryBack $categoryBack, bool $synchronizeImage = false): void
    {
        $category = $this->categoryRepository->findOneByBackId($categoryBack->getCategoryId());
        $categoryFront = $this->getCategoryFrontFromCategory($category);
        $this->updateCategoryFrontAndOtherFromCategoryBack($categoryBack, $categoryFront);
        $category = $this->createOrUpdateCategory(
            $category,
            $categoryBack->getCategoryId(),
            $categoryFront->getCategoryId()
        );

        $this->eventDispatcher->dispatch(new CategorySynchronizedEvent($category, $synchronizeImage));
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
    protected function updateCategoryFrontAndOtherFromCategoryBack(
        CategoryBack $categoryBack,
        CategoryFront $categoryFront
    ): CategoryFront
    {
        $parentId = $this->categorySynchronizerHelper->getParentIdFromCategoryBack($categoryBack);

        $this->updateCategoryFrontFromCategoryBack($categoryBack, $categoryFront, $parentId);
        $this->updateCategoryPathsFrontFromCategoryBack($categoryFront, $parentId);
        $this->updateCategoryDescriptionFrontFromCategoryBack($categoryBack, $categoryFront);
        $this->updateCategoryLayoutFrontFromCategoryBack($categoryFront);
        $this->updateCategoryStoreFrontFromCategoryBack($categoryFront);

        return $categoryFront;
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     * @param int $parentId
     * @return CategoryFront
     */
    protected function updateCategoryFrontFromCategoryBack(
        CategoryBack $categoryBack,
        CategoryFront $categoryFront,
        int $parentId
    ): CategoryFront
    {
        if (null === $categoryFront->getImage()) {
            $categoryFront->setImage($this->defaultImagePath);
        }

        $categoryFront->setParentId($parentId);

        if (null === $categoryFront->getTop()) {
            $categoryFront->setTop(false);
        }

        if (null === $categoryFront->getColumn()) {
            $categoryFront->setColumn(1);
        }

        $categoryFront->setSortOrder($categoryBack->getSortOrder());

        if (null === $categoryFront->getStatus() || true === $categoryFront->getStatus()) {
            $categoryFront->setStatus($categoryBack->getEnabled());
        }

        $this->categoryFrontRepository->persistAndFlush($categoryFront);

        return $categoryFront;
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     * @return CategoryDescriptionFront
     */
    protected function updateCategoryDescriptionFrontFromCategoryBack(
        CategoryBack $categoryBack,
        CategoryFront $categoryFront
    ): CategoryDescriptionFront
    {
        $categoryDescriptionFront = $this->categoryDescriptionFrontRepository->findOneByCategoryFrontIdAndLanguageId(
            $categoryFront->getCategoryId(),
            $this->storeFront->getDefaultLanguageId()
        );

        if (null === $categoryDescriptionFront) {
            $categoryDescriptionFront = new CategoryDescriptionFront();
        }

        $categoryDescriptionFront->setCategoryId($categoryFront->getCategoryId());
        $categoryDescriptionFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $categoryDescriptionFront->setName(Filler::securityString(Store::encodingConvert($categoryBack->getName())));
        $categoryDescriptionFront->setDescription(
            Filler::securityString(Store::encodingConvert($categoryBack->getDescription()))
        );

        if (null === $categoryDescriptionFront->getMetaTitle()) {
            $categoryDescriptionFront->setMetaTitle('');
        }

        if (null === $categoryDescriptionFront->getMetaDescription()) {
            $categoryDescriptionFront->setMetaDescription('');
        }

        $categoryDescriptionFront->setMetaKeyword(Filler::securityString($categoryBack->getMetaKeywords()));

        $this->categoryDescriptionFrontRepository->persistAndFlush($categoryDescriptionFront);

        return $categoryDescriptionFront;
    }

    /**
     * @param CategoryFront $categoryFront
     * @return CategoryLayoutFront
     */
    protected function updateCategoryLayoutFrontFromCategoryBack(CategoryFront $categoryFront): CategoryLayoutFront
    {
        $categoryLayoutFront = $this->categoryLayoutFrontRepository->findOneByCategoryFrontIdAndStoreId(
            $categoryFront->getCategoryId(),
            $this->storeFront->getDefaultStoreId()
        );

        if (null === $categoryLayoutFront) {
            $categoryLayoutFront = new CategoryLayoutFront();
        }

        $categoryLayoutFront->setCategoryId($categoryFront->getCategoryId());
        $categoryLayoutFront->setStoreId($this->storeFront->getDefaultStoreId());
        $categoryLayoutFront->setLayoutId($this->storeFront->getDefaultCategoryLayoutId());

        $this->categoryLayoutFrontRepository->persistAndFlush($categoryLayoutFront);

        return $categoryLayoutFront;
    }

    /**
     * @param CategoryFront $categoryFront
     * @return CategoryStoreFront
     */
    protected function updateCategoryStoreFrontFromCategoryBack(CategoryFront $categoryFront): CategoryStoreFront
    {
        $categoryStoreFront = $this->categoryStoreFrontRepository->findOneByCategoryFrontIdAndStoreId(
            $categoryFront->getCategoryId(),
            $this->storeFront->getDefaultStoreId()
        );

        if (null === $categoryStoreFront) {
            $categoryStoreFront = new CategoryStoreFront();
        }

        $categoryStoreFront->setCategoryId($categoryFront->getCategoryId());
        $categoryStoreFront->setStoreId($this->storeFront->getDefaultStoreId());

        $this->categoryStoreFrontRepository->persistAndFlush($categoryStoreFront);

        return $categoryStoreFront;
    }

    /**
     * @param CategoryFront $categoryFront
     * @param int $parentId
     */
    protected function updateCategoryPathsFrontFromCategoryBack(CategoryFront $categoryFront, int $parentId)
    {
        if ($this->storeFront->getDefaultCategoryFrontId() !== $parentId) {
            $categoryPath = $this->categoryPathFrontRepository->findOneByCategoryFrontIdAndPathId(
                $categoryFront->getCategoryId(),
                $parentId
            );

            if (null !== $categoryPath) {
                $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
            }

            $categoryPath = new CategoryPathFront();
            $categoryPath->setCategoryId($categoryFront->getCategoryId());
            $categoryPath->setPathId($parentId);
            $categoryPath->setLevel(0);
            $this->categoryPathFrontRepository->persistAndFlush($categoryPath);
        }

        $categoryPath = $this->categoryPathFrontRepository->findOneByCategoryFrontIdAndPathId(
            $categoryFront->getCategoryId(),
            $categoryFront->getCategoryId()
        );

        if (null !== $categoryPath) {
            $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
        }

        $categoryPath = new CategoryPathFront();
        $categoryPath->setCategoryId($categoryFront->getCategoryId());
        $categoryPath->setPathId($categoryFront->getCategoryId());
        $categoryPath->setLevel(1);

        $this->categoryPathFrontRepository->persistAndFlush($categoryPath);
    }

    /**
     * @param Category $category
     * @param int $backId
     * @param int $frontId
     * @return Category
     */
    protected function createOrUpdateCategory(?Category $category, int $backId, int $frontId): Category
    {
        if (null === $category) {
            $category = new Category();
        }

        $category->setBackId($backId);
        $category->setFrontId($frontId);

        $this->categoryRepository->persistAndFlush($category);

        return $category;
    }
}