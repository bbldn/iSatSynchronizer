<?php

namespace App\Command;

use App\Exception\ProductBackNotFoundException;
use App\Service\Synchronizer\BackToFront\ProductSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductOneSynchronizeCommand extends Command
{
    protected static $defaultName = 'product:one:synchronize';
    private $productSynchronize;

    public function __construct(ProductSynchronize $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Product one Synchronize');
        $this->addArgument('idProduct', InputArgument::REQUIRED, 'Product `id`');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('idProduct');
        if (0 === preg_match('/[0-9]+/', $id)) {
            $output->writeln("`id` must be int: {$id}");

            return -1;
        }

        $loadImage = $input->getArgument('loadImage') !== null;
        try {
            $this->productSynchronize->synchronizeOne((int)$id, $loadImage);
        } catch (ProductBackNotFoundException $notFoundException) {
            $output->writeln("Product Back with `id`: {$id} not found");

            return -1;
        }

        return 0;
    }
}