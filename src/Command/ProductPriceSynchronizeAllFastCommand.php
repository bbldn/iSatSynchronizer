<?php

namespace App\Command;

use App\Repository\Front\ProductDiscountRepository;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeAllFastCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:all:fast';

    /** @var ProductSynchronizer $productSynchronizer */
    protected $productSynchronizer;

    /**
     * ProductPriceSynchronizeAllFastCommand constructor.
     * @param ProductSynchronizer $productSynchronizer
     */
    public function __construct(ProductSynchronizer $productSynchronizer)
    {
        $this->productSynchronizer = $productSynchronizer;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productSynchronizer->load()->synchronizePriceAllFast();

        return 0;
    }
}