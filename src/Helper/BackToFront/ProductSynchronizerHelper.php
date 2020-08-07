<?php

namespace App\Helper\BackToFront;

use App\Contract\BackToFront\ProductSynchronizerHelperInterface;
use App\Entity\Front\Category as CategoryFront;
use App\Exception\CategoryBackNotFoundException;
use App\Exception\CategoryFrontNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class ProductSynchronizerHelper implements ProductSynchronizerHelperInterface
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
        try {
            return $this->_getCategoryFrontByCategoryBackId($categoryBackId);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }

        return null;
    }

    /**
     * @param int|null $categoryBackId
     * @return CategoryFront|null
     * @throws CategoryBackNotFoundException
     * @throws CategoryFrontNotFoundException
     */
    protected function _getCategoryFrontByCategoryBackId(?int $categoryBackId): ?CategoryFront
    {
        if (null === $categoryBackId) {
            return null;
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            throw new CategoryBackNotFoundException("CategoryBack with id: {$categoryBackId} not found");
        }

        $categoryFront = $this->categoryFrontRepository->find($category->getFrontId());

        if (null === $categoryFront) {
            throw new CategoryFrontNotFoundException(
                "CategoryFront with id: {$category->getFrontId()} not found"
            );
        }

        return $categoryFront;
    }
}