<?php

namespace App\Command;

use App\Contract\BackToFront\ProductSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeByCategoryIdLiteCommand extends Command
{
    protected static $defaultName = 'product:synchronize:by-category-id:lite';

    /** @var ProductSynchronizerInterface $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductSynchronizeByCategoryIdCommand constructor.
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
        $this->setDescription('Synchronize product');
        $this->addArgument('ids', InputArgument::REQUIRED, 'ids');
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
        $ids = $this->parseIdArray($input);

        foreach ($ids as $id) {
            $this->productSynchronize->synchronizeByCategoryIdLite($id);
        }

        return Command::SUCCESS;
    }
}