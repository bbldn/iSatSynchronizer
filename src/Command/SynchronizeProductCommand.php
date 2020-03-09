<?php

namespace App\Command;

use App\Service\ProductSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizeProductCommand extends Command
{
    protected static $defaultName = 'synchronize:products';
    private $productSynchronize;

    public function __construct(ProductSynchronize $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize categories');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Load image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productSynchronize->synchronize();
        return 0;
    }
}