<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeByCategoryIdCommand extends Command
{
    protected static $defaultName = 'product:synchronize:by-category-id';

    /** @var ProductSynchronizer $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductSynchronizeByCategoryIdCommand constructor.
     * @param ProductSynchronizer $productSynchronize
     */
    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize product');
        $this->addArgument('ids', InputArgument::REQUIRED, 'ids');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Load image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->parseIdArray($input);
        $loadImage = $input->getArgument('loadImage') !== null;

        foreach ($ids as $id) {
            $this->productSynchronize->synchronizeByCategoryId($id, $loadImage);
        }

        return 0;
    }
}