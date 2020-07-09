<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSeoUrlSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSeoUrlSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'product:seo-url:synchronize:all';

    /** @var ProductSeoUrlSynchronizerContract $productSeoUrlSynchronizer */
    protected $productSeoUrlSynchronizer;

    /**
     * ProductSeoUrlSynchronizeAllCommand constructor.
     * @param ProductSeoUrlSynchronizerContract $productSeoUrlSynchronizer
     */
    public function __construct(ProductSeoUrlSynchronizerContract $productSeoUrlSynchronizer)
    {
        $this->productSeoUrlSynchronizer = $productSeoUrlSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize products SeoUrl');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->productSeoUrlSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productSeoUrlSynchronizer->synchronizeAll();

        return 0;
    }
}