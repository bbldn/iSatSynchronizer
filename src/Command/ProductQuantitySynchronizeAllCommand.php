<?php

namespace App\Command;

use App\Helper\BackToFront\ProductQuantityHelper;
use App\Helper\ExceptionFormatter;
use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class ProductQuantitySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'product:quantity:synchronize:all';

    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductQuantityHelper $productQuantityHelper */
    protected $productQuantityHelper;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /**
     * ProductQuantitySynchronizeAllCommand constructor.
     * @param LoggerInterface $logger
     * @param ProductQuantityHelper $productQuantityHelper
     * @param ProductRepository $productRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ProductQuantityHelper $productQuantityHelper,
        ProductRepository $productRepository)
    {
        $this->logger = $logger;
        $this->productQuantityHelper = $productQuantityHelper;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize product quantity');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->productRepository->findAll() as $product) {
            try {
                $this->productQuantityHelper->action($product);
            } catch (Throwable $e) {
                $this->logger->error(ExceptionFormatter::e($e));
            }
        }

        return 0;
    }
}