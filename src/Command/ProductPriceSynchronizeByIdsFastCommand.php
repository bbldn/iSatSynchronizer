<?php

namespace App\Command;

use App\Contract\BackToFront\ProductDiscountSpeedSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeByIdsFastCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:by-ids:fast';

    /** @var ProductDiscountSpeedSynchronizerContract $productDiscountRepository */
    protected $productDiscountSpeedSynchronizer;

    /**
     * ProductPriceSynchronizeAllFastCommand constructor.
     * @param ProductDiscountSpeedSynchronizerContract $productSynchronizer
     */
    public function __construct(ProductDiscountSpeedSynchronizerContract $productSynchronizer)
    {
        $this->productDiscountSpeedSynchronizer = $productSynchronizer;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->productDiscountSpeedSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->testIds($input);
        $this->productDiscountSpeedSynchronizer->synchronizeByIds($ids);

        return 0;
    }
}