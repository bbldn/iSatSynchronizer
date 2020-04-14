<?php

namespace App\Command;

use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductPriceUpdateByCategoryIdCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'product:price:update:by-category-id';
    private $productSynchronize;

    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize product');
        $this->addArgument('ids', InputArgument::REQUIRED, 'ids');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->parseIdArray($input);

        return 0;
    }
}