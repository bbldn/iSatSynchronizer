<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerContract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductClearCommand extends Command
{
    protected static $defaultName = 'product:clear';

    /** @var ProductSynchronizerContract $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductClearCommand constructor.
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
    protected function configure(): void
    {
        $this->setDescription('Clear products');
        $this->addArgument('removeImage', InputArgument::OPTIONAL, 'remove image');
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
        $removeImage = $input->getArgument('removeImage') !== null;
        $this->productSynchronize->clear($removeImage);

        return 0;
    }
}