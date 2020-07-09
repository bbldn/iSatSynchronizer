<?php

namespace App\Command;

use App\Contract\BackToFront\AttributeSynchronizerContract;
use App\Contract\BackToFront\CategorySynchronizerContract;
use App\Contract\BackToFront\ProductSynchronizerContract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllClearCommand extends Command
{
    protected static $defaultName = 'all:clear';

    /** @var AttributeSynchronizerContract $attributeSynchronizer */
    protected $attributeSynchronizer;

    /** @var CategorySynchronizerContract $categorySynchronizer */
    protected $categorySynchronizer;

    /** @var ProductSynchronizerContract $productSynchronizer */
    protected $productSynchronizer;

    /**
     * AllClearCommand constructor.
     * @param AttributeSynchronizerContract $attributeSynchronizer
     * @param CategorySynchronizerContract $categorySynchronizer
     * @param ProductSynchronizerContract $productSynchronizer
     */
    public function __construct(
        AttributeSynchronizerContract $attributeSynchronizer,
        CategorySynchronizerContract $categorySynchronizer,
        ProductSynchronizerContract $productSynchronizer
    )
    {
        $this->attributeSynchronizer = $attributeSynchronizer;
        $this->categorySynchronizer = $categorySynchronizer;
        $this->productSynchronizer = $productSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Clear all');
        $this->addArgument('resetImage', InputArgument::OPTIONAL, 'Reset image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->productSynchronizer->load();
        $this->attributeSynchronizer->load();
        $this->categorySynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $resetImage = $input->getArgument('resetImage') !== null;

        $this->productSynchronizer->clear($resetImage);
        $this->attributeSynchronizer->clear();
        $this->categorySynchronizer->clear($resetImage);

        return 0;
    }
}