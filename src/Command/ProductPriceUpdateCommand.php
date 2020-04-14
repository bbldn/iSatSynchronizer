<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceUpdateCommand extends Command
{
    protected static $defaultName = 'product:price:update:all';
    private $productSynchronize;

    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Products price synchronize');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productSynchronize->updatePriceAll();

        return 0;
    }
}