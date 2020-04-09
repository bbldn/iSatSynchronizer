<?php

namespace App\Service\API;

use App\Other\Back\CategoryTreeGenerator;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;

class ProductService
{
    protected $categoryBackRepository;

    public function __construct(CategoryBackRepository $categoryBackRepository)
    {
        $this->categoryBackRepository = $categoryBackRepository;
    }

    public function getCategories(): array
    {
        return CategoryTreeGenerator::generate($this->categoryBackRepository->findAllSortByParent());
    }

    public function updateProductsByCategoriesIds(string $ids)
    {
        return ['ok' => true];
    }
}