<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeByCategoryIdCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:by-category-id';

    /** @var ProductSynchronizerInterface $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductPriceUpdateByCategoryIdCommand constructor.
     * @param ProductSynchronizerInterface $productSynchronizer
     */
    public function __construct(ProductSynchronizerInterface $productSynchronizer)
    {
        $this->productSynchronize = $productSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize product');
        $this->addArgument('ids', InputArgument::REQUIRED, 'ids');
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
        $ids = $this->getIdsFromInput($input);
        $this->productSynchronize->synchronizePriceByCategoryIds($ids);

        return 0;
    }
}