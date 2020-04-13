<?php

namespace App\Command;

use App\Exception\ProductBackNotFoundException;
use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeByIdsCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'product:synchronize:by-ids';
    private $productSynchronize;

    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Product one Synchronize');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Product `id`');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->testIds($input);
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->productSynchronize->synchronizeByIds($ids, $loadImage);

        return 0;
    }
}