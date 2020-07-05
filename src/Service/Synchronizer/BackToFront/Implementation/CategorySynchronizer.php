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
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
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
use App\Repository\Front\SeoUrlRepository as SeoUrlFrontRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use Psr\Log\LoggerInterface;

class CategorySynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

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

    /** @var SeoUrlFrontRepository $seoUrlFrontRepository */
    protected $seoUrlFrontRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var CategoryImageSynchronizer $categoryImageSynchronizer */
    protected $categoryImageSynchronizer;

    /** @var string[] $urls */
    protected $urls = [];

    /** @var bool $synchronizeImage */
    protected $synchronizeImage = false;

    /** @var string $defaultImagePath */
    protected $defaultImagePath = null;

    /**
     * CategorySynchronizer constructor.
     * @param LoggerInterface $logger
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
     * @param SeoUrlFrontRepository $seoUrlFrontRepository
     * @param ProductBackRepository $productBackRepository
     * @param CategoryImageSynchronizer $categoryImageSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
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
        SeoUrlFrontRepository $seoUrlFrontRepository,
        ProductBackRepository $productBackRepository,
        CategoryImageSynchronizer $categoryImageSynchronizer
    )
    {
        $this->logger = $logger;
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
        $this->seoUrlFrontRepository = $seoUrlFrontRepository;
        $this->productBackRepository = $productBackRepository;
        $this->categoryImageSynchronizer = $categoryImageSynchronizer;
    }

    /**
     * @param bool $clearImage
     */
    protected function clear(bool $clearImage = false): void
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

        if (true === $this->seoUrlFrontRepository->tableExists()) {
            $this->seoUrlFrontRepository->removeAllByQuery('category_id');
        }

        if (true === $clearImage) {
            $this->categoryImageSynchronizer->clearFolder();
        }
    }

    /**
     * @param CategoryBack $categoryBack
     * @param bool $synchronizeImage
     */
    protected function synchronizeCategory(CategoryBack $categoryBack, bool $synchronizeImage = false): void
    {
        $this->synchronizeImage = $synchronizeImage;
        $category = $this->categoryRepository->findOneByBackId($categoryBack->getCategoryId());
        $categoryFront = $this->getCategoryFrontFromCategory($category);
        $this->updateCategoryFrontFromCategoryBack($categoryBack, $categoryFront);
        $this->createOrUpdateCategory($category, $categoryBack->getCategoryId(), $categoryFront->getCategoryId());
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
        if (false === in_array($parentBackId, $this->storeBack->getDefaultRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }

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

        $categoryFrontId = $categoryFront->getCategoryId();

        if ($this->storeFront->getDefaultCategoryFrontId() !== $parentId) {
            $categoryPath = $this->categoryPathFrontRepository->findOneByCategoryFrontIdAndPathId(
                $categoryFrontId,
                $parentId
            );

            if (null !== $categoryPath) {
                $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
            }

            $categoryPath = new CategoryPathFront();
            $categoryPath->setCategoryId($categoryFrontId);
            $categoryPath->setPathId($parentId);
            $categoryPath->setLevel(0);
            $this->categoryPathFrontRepository->persistAndFlush($categoryPath);
        }

        $categoryPath = $this->categoryPathFrontRepository->findOneByCategoryFrontIdAndPathId(
            $categoryFrontId,
            $categoryFrontId
        );

        if (null !== $categoryPath) {
            $this->categoryPathFrontRepository->removeAndFlush($categoryPath);
        }

        $categoryPath = new CategoryPathFront();
        $categoryPath->setCategoryId($categoryFrontId);
        $categoryPath->setPathId($categoryFrontId);
        $categoryPath->setLevel(1);
        $this->categoryPathFrontRepository->persistAndFlush($categoryPath);

        $categoryDescription = $this->categoryDescriptionFrontRepository->findOneByCategoryFrontIdAndLanguageId(
            $categoryFrontId,
            $this->storeFront->getDefaultLanguageId()
        );

        if (null === $categoryDescription) {
            $categoryDescription = new CategoryDescription();
        }

        $categoryDescription->setCategoryId($categoryFrontId);
        $categoryDescription->setLanguageId($this->storeFront->getDefaultLanguageId());
        $categoryDescription->setName(Filler::securityString(Store::encodingConvert($categoryBack->getName())));
        $categoryDescription->setDescription(
            Filler::securityString(Store::encodingConvert($categoryBack->getDescription()))
        );

        if (null === $categoryDescription->getMetaTitle()) {
            $categoryDescription->setMetaTitle('');
        }

        if (null === $categoryDescription->getMetaDescription()) {
            $categoryDescription->setMetaDescription('');
        }

        $categoryDescription->setMetaKeyword(Filler::securityString($categoryBack->getMetaKeywords()));

        $this->categoryDescriptionFrontRepository->persistAndFlush($categoryDescription);

        $categoryLayout = $this->categoryLayoutFrontRepository->findOneByCategoryFrontIdAndStoreId(
            $categoryFrontId,
            $this->storeFront->getDefaultStoreId()
        );

        if (null === $categoryLayout) {
            $categoryLayout = new CategoryLayout();
        }

        $categoryLayout->setCategoryId($categoryFrontId);
        $categoryLayout->setStoreId($this->storeFront->getDefaultStoreId());
        $categoryLayout->setLayoutId($this->storeFront->getDefaultCategoryLayoutId());

        $this->categoryLayoutFrontRepository->persistAndFlush($categoryLayout);

        $categoryStore = $this->categoryStoreFrontRepository->findOneByCategoryFrontIdAndStoreId(
            $categoryFrontId,
            $this->storeFront->getDefaultStoreId()
        );

        if (null === $categoryStore) {
            $categoryStore = new CategoryStore();
        }

        $categoryStore->setCategoryId($categoryFrontId);
        $categoryStore->setStoreId($this->storeFront->getDefaultStoreId());
        $this->categoryStoreFrontRepository->persistAndFlush($categoryStore);

        if (true === $this->seoUrlFrontRepository->tableExists()) {
            $seoUrl = $this->seoUrlFrontRepository->findOneByQueryAndLanguageId(
                "category_id={$categoryFrontId}",
                $this->storeFront->getDefaultLanguageId()
            );

            $this->synchronizeSeoUrl($seoUrl, $categoryFrontId, $categoryBack);
        }

        if (true === $this->synchronizeImage) {
            $this->categoryImageSynchronizer->synchronizeImage($categoryBack, $categoryFront);
        }

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
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            $error = "Category with id: {$category->getId()} does not have frontId";
            $this->logger->error(ExceptionFormatter::f($error));

            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $front = $this->categoryFrontRepository->find($frontId);

        if (null === $front) {
            $this->logger->error(ExceptionFormatter::f("Front Category with id: {$frontId} not found"));

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

        $seoUrl->setStoreId($this->storeFront->getDefaultStoreId());
        $seoUrl->setLanguageId($this->storeFront->getDefaultLanguageId());
        $seoUrl->setQuery('category_id=' . $categoryFrontId);

        $slug = trim(Filler::securityString($categoryBack->getSlug()));

        if (0 === mb_strlen($slug)) {
            if (true === key_exists($categoryBack->getCategoryId(), $this->urls)) {
                $slug = $this->urls[$categoryBack->getCategoryId()];
            } else {
                $slug = StoreFront::generateURL(
                    $categoryBack->getCategoryId(),
                    Store::encodingConvert($categoryBack->getName())
                );
            }

            $seoUrl->setKeyword($slug);
        } else {
            $seoUrl->setKeyword($slug);
        }

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
     *
     */
    protected function getSeoUrlFromProducts(): array
    {
        $urls = [];
        $slugs = $this->productBackRepository->getAllSlugs();

        foreach ($slugs as $slug) {
            $result = preg_match('/^([0-9]+)(.+)?\/([0-9]+)(.+)$/', $slug['slug'], $data);
            if (0 === $result) {
                continue;
            }

            $urls[$data[1]] = $data[1] . $data[2];
        }

        return $urls;
    }
}