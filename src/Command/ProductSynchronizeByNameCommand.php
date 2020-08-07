<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeByNameCommand extends Command
{
    protected static $defaultName = 'product:synchronize:by-name';

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
        $this->setDescription('Product one synchronize by name');
        $this->addArgument('name', InputArgument::REQUIRED, 'Product `name`');
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
        $name = $input->getArgument('name');
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->productSynchronize->synchronizeByName($name, $loadImage);

        return Command::SUCCESS;
    }
}