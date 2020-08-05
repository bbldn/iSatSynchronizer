<?php

namespace App\Command;

use App\Contract\BackToFront\CategorySynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorySynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'category:synchronize:by-ids';

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
        $this->addArgument('ids', InputArgument::REQUIRED, 'Category ids');
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
        $ids = $this->getIdsFromInput($input);
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->categorySynchronizer->synchronizeByIds($ids, $loadImage);

        return 0;
    }
}