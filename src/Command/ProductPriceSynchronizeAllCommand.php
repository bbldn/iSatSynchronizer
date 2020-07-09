<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:all';

    /** @var ProductSynchronizerContract $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductPriceUpdateCommand constructor.
     * @param ProductSynchronizerContract $productSynchronizer
     */
    public function __construct(ProductSynchronizerContract $productSynchronizer)
    {
        $this->productSynchronize = $productSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Products price synchronize');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->productSynchronize->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productSynchronize->synchronizePriceAll();

        return 0;
    }
}