<?php

namespace App\Command;

use App\Repository\Front\ProductDiscountRepository;
use App\Service\Synchronizer\BackToFront\ProductDiscountSpeedSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceSynchronizeByIdsFastCommand extends Command
{
    protected static $defaultName = 'product:price:synchronize:by-ids:fast';

    /** @var ProductDiscountRepository $productDiscountRepository */
    protected $productDiscountSpeedSynchronizer;

    /**
     * ProductPriceSynchronizeAllFastCommand constructor.
     * @param ProductDiscountSpeedSynchronizer $productSynchronizer
     */
    public function __construct(ProductDiscountSpeedSynchronizer $productSynchronizer)
    {
        $this->productDiscountSpeedSynchronizer = $productSynchronizer;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->testIds($input);
        $this->productDiscountSpeedSynchronizer->load()->synchronizeByIds($ids);

        return 0;
    }
}