<?php

namespace App\Command;

use App\Service\Synchronizer\ProductSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductsClearCommand extends Command
{
    protected static $defaultName = 'products:clear';
    private $productSynchronize;

    public function __construct(ProductSynchronize $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Clear products');
        $this->addArgument('removeImage', InputArgument::OPTIONAL, 'remove image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $removeImage = $input->hasArgument('removeImage');
        $this->productSynchronize->clear($removeImage);

        return 0;
    }
}