<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeByCategoryIdCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:by-category-id';

    /** @var ProductSynchronizer $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductPriceUpdateByCategoryIdCommand constructor.
     * @param ProductSynchronizer $productSynchronize
     */
    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
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
     *
     */
    protected function load(): void
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
        parent::execute($input, $output);
        $ids = $this->testIds($input);
        $this->productSynchronize->synchronizePriceByCategoryIds($ids);

        return 0;
    }
}