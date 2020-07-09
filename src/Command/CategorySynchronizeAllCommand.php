<?php

namespace App\Command;

use App\Contract\BackToFront\CategorySynchronizerContract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'category:synchronize:all';

    /** @var CategorySynchronizerContract $categorySynchronizer */
    protected $categorySynchronizer;

    /**
     * CategorySynchronizeAllCommand constructor.
     * @param CategorySynchronizerContract $categorySynchronizer
     */
    public function __construct(CategorySynchronizerContract $categorySynchronizer)
    {
        $this->categorySynchronizer = $categorySynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Synchronize categories');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Load image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->categorySynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->categorySynchronizer->synchronizeAll($loadImage);

        return 0;
    }
}
