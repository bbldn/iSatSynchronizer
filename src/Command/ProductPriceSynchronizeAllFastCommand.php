<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeAllFastCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:all:fast';

    /** @var ProductSynchronizerContract $productSynchronizer */
    protected $productSynchronizer;

    /**
     * ProductPriceSynchronizeAllFastCommand constructor.
     * @param ProductSynchronizerContract $productSynchronizer
     */
    public function __construct(ProductSynchronizerContract $productSynchronizer)
    {
        $this->productSynchronizer = $productSynchronizer;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->productSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productSynchronizer->synchronizePriceAllFast();

        return 0;
    }
}