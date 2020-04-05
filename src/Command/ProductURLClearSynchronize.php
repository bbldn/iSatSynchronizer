<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductURLSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductURLClearSynchronize extends Command
{
    protected static $defaultName = 'product-url:clear';

    private $productURLSynchronizer;

    public function __construct(ProductURLSynchronizer $productURLSynchronizer)
    {
        $this->productURLSynchronizer = $productURLSynchronizer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Clear products urls');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productURLSynchronizer->clear();

        return 0;
    }
}