<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'product:synchronize:by-ids';

    /** @var ProductSynchronizerInterface $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductSynchronizeByIdsCommand constructor.
     * @param ProductSynchronizerInterface $productSynchronizer
     */
    public function __construct(ProductSynchronizerInterface $productSynchronizer)
    {
        $this->productSynchronize = $productSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Product one Synchronize');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Product `id`');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->productSynchronize->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->getIdsFromInput($input);
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->productSynchronize->synchronizeByIds($ids, $loadImage);

        return 0;
    }
}