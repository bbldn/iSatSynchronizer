<?php

namespace App\Command;

use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceUpdateByIdsCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'product:price:update:by-ids';
    private $productSynchronize;

    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Products price synchronize');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Ids');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->testIds($input);
        $this->productSynchronize->updatePriceByIds($ids);

        return 0;
    }
}