<?php

namespace App\Helper\BackToFront;

use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use Psr\Log\LoggerInterface;
use App\Entity\Back\Category as CategoryBack;
use App\Helper\Back\Store as StoreBack;

class CategorySynchronizerHelper
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var CategoryRepository $categoryRepository */
    protected $categoryRepository;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /**
     * CategorySynchronizerHelper constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param CategoryRepository $categoryRepository
     * @param CategoryFrontRepository $categoryFrontRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        StoreBack $storeBack,
        CategoryRepository $categoryRepository,
        CategoryFrontRepository $categoryFrontRepository
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->categoryRepository = $categoryRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
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
     * @param CategoryBack $categoryBack
     * @return int
     */
    public function getParentIdFromCategoryBack(CategoryBack $categoryBack): int
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = $this->storeFront->getDefaultCategoryFrontId();
        if (false === in_array($parentBackId, $this->storeBack->getDefaultRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }

        return $parentId;
    }
}