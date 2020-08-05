<?php

namespace App\Command;

use App\Contract\BackToFront\AttributeSynchronizerInterface;
use App\Contract\BackToFront\CategorySynchronizerInterface;
use App\Contract\BackToFront\ProductSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllClearCommand extends Command
{
    protected static $defaultName = 'all:clear';

    /** @var AttributeSynchronizerInterface $attributeSynchronizer */
    protected $attributeSynchronizer;

    /** @var CategorySynchronizerInterface $categorySynchronizer */
    protected $categorySynchronizer;

    /** @var ProductSynchronizerInterface $productSynchronizer */
    protected $productSynchronizer;

    /**
     * AllClearCommand constructor.
     * @param AttributeSynchronizerInterface $attributeSynchronizer
     * @param CategorySynchronizerInterface $categorySynchronizer
     * @param ProductSynchronizerInterface $productSynchronizer
     */
    public function __construct(
        AttributeSynchronizerInterface $attributeSynchronizer,
        CategorySynchronizerInterface $categorySynchronizer,
        ProductSynchronizerInterface $productSynchronizer
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