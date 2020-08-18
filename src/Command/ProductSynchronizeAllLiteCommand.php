<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeAllLiteCommand extends Command
{
    protected static $defaultName = 'product:synchronize:all:lite';

    /** @var ProductSynchronizerInterface $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductSynchronizeAllCommand constructor.
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
    protected function configure(): void
    {
        $this->setDescription('Synchronize lite products');
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
        $this->productSynchronize->synchronizeAllLite();

        return Command::SUCCESS;
    }
}