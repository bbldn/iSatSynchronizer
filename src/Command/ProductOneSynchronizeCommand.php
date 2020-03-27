<?php

namespace App\Command;

use App\Exception\ProductBackNotFoundException;
use App\Service\Synchronizer\BackToFront\ProductSynchronize;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductOneSynchronizeCommand extends OneSynchronizeCommand
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
        $this->addArgument('id', InputArgument::REQUIRED, 'Product `id`');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $this->parseId($input);
        $loadImage = $input->getArgument('loadImage') !== null;

        try {
            $this->productSynchronize->synchronizeOne($id, $loadImage);
        } catch (ProductBackNotFoundException $notFoundException) {
            throw new \InvalidArgumentException("Product Back with `id`: {$id} not found");
        }

        return 0;
    }
}