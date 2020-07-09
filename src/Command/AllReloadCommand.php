<?php

namespace App\Command;

use App\Contract\BackToFront\AttributeSynchronizerContract;
use App\Contract\BackToFront\CategorySynchronizerContract;
use App\Contract\BackToFront\ProductSynchronizerContract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllReloadCommand extends Command
{
    protected static $defaultName = 'all:reload';

    /** @var AttributeSynchronizerContract $attributeSynchronizer */
    protected $attributeSynchronizer;

    /** @var CategorySynchronizerContract $categorySynchronizer */
    protected $categorySynchronizer;

    /** @var ProductSynchronizerContract $productSynchronizer */
    protected $productSynchronizer;

    /**
     * AllReloadCommand constructor.
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
        $this->setDescription('Reload all');
        $this->addArgument('reloadImage', InputArgument::OPTIONAL, 'Reload image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->categorySynchronizer->load();
        $this->attributeSynchronizer->load();
        $this->productSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $reloadImage = $input->getArgument('reloadImage') !== null;

        $this->categorySynchronizer->reload($reloadImage);
        $this->attributeSynchronizer->reload();
        $this->productSynchronizer->reload($reloadImage);

        return 0;
    }
}