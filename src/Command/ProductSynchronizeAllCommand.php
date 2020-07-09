<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerContract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'product:synchronize:all';

    /** @var ProductSynchronizerContract $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductSynchronizeAllCommand constructor.
     * @param ProductSynchronizerContract $productSynchronizer
     */
    public function __construct(ProductSynchronizerContract $productSynchronizer)
    {
        $this->productSynchronize = $productSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize products');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Load image');
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
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->productSynchronize->synchronizeAll($loadImage);

        return 0;
    }
}