<?php

namespace App\Command;

use App\Helper\BackToFront\ProductQuantityHelper;
use App\Helper\ExceptionFormatter;
use App\Repository\ProductRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class ProductQuantitySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'product:quantity:synchronize:all';

    /** @var ProductQuantityHelper $productQuantityHelper */
    protected $productQuantityHelper;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /**
     * ProductQuantitySynchronizeAllCommand constructor.
     * @param ProductQuantityHelper $productQuantityHelper
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductQuantityHelper $productQuantityHelper,
        ProductRepository $productRepository)
    {
        $this->productQuantityHelper = $productQuantityHelper;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            foreach ($this->productRepository->findAll() as $product) {
                $this->productQuantityHelper->action($product);
            }
        } catch (Throwable $e) {
            ExceptionFormatter::e($e);
        }

        return 0;
    }
}