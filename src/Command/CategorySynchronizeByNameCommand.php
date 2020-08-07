<?php

namespace App\Command;

use App\Contract\BackToFront\CategorySynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorySynchronizeByNameCommand extends Command
{
    protected static $defaultName = 'category:synchronize:by-name';

    /** @var CategorySynchronizerInterface $categorySynchronizer */
    protected $categorySynchronizer;

    /**
     * CategorySynchronizeByIdsCommand constructor.
     * @param CategorySynchronizerInterface $categorySynchronizer
     */
    public function __construct(CategorySynchronizerInterface $categorySynchronizer)
    {
        $this->categorySynchronizer = $categorySynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Category one synchronize');
        $this->addArgument('name', InputArgument::REQUIRED, 'Category name');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
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
        $name = $input->getArgument('name');
        $this->categorySynchronizer->synchronizeByName($name, $loadImage);

        return Command::SUCCESS;
    }

}