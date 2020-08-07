<?php

namespace App\Command;

use App\Contract\BackToFront\ProductDiscountSpeedSynchronizerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeByIdsFastCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:by-ids:fast';

    /** @var ProductDiscountSpeedSynchronizerInterface $productDiscountRepository */
    protected $productDiscountSpeedSynchronizer;

    /**
     * ProductPriceSynchronizeAllFastCommand constructor.
     * @param ProductDiscountSpeedSynchronizerInterface $productSynchronizer
     */
    public function __construct(ProductDiscountSpeedSynchronizerInterface $productSynchronizer)
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
        $ids = $this->getIdsFromInput($input);
        $this->productDiscountSpeedSynchronizer->synchronizeByIds($ids);

        return Command::SUCCESS;
    }
}