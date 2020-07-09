<?php

namespace App\Helper\BackToFront;

use App\Contract\BackToFront\ProductSynchronizerHelperContract;
use App\Entity\Front\Category as CategoryFront;
use App\Helper\ExceptionFormatter;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use Psr\Log\LoggerInterface;

class ProductSynchronizerHelper implements ProductSynchronizerHelperContract
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var CategoryRepository $categoryRepository */
    protected $categoryRepository;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /**
     * ProductSynchronizerHelper constructor.
     * @param LoggerInterface $logger
     * @param CategoryRepository $categoryRepository
     * @param CategoryFrontRepository $categoryFrontRepository
     */
    public function __construct(
        LoggerInterface $logger,
        CategoryRepository $categoryRepository,
        CategoryFrontRepository $categoryFrontRepository
    )
    {
        $this->logger = $logger;
        $this->categoryRepository = $categoryRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
    }

    /**
     * @param int|null $categoryBackId
     * @return CategoryFront|null
     */
    public function getCategoryFrontByCategoryBackId(?int $categoryBackId): ?CategoryFront
    {
        if (null === $categoryBackId) {
            return null;
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            $message = "Category with backId {$categoryBackId} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            $message = "Category front id is null";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $categoryFront = $this->categoryFrontRepository->find($frontId);

        if (null === $categoryFront) {
            $message = "Category description front is null";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        return $categoryFront;
    }
}