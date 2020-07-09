<?php

namespace App\Command;

use App\Contract\BackToFront\CategorySynchronizerContract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryClearCommand extends Command
{
    protected static $defaultName = 'category:clear';

    /** @var CategorySynchronizerContract $categorySynchronizer */
    protected $categorySynchronizer;

    /**
     * CategoryClearCommand constructor.
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
        $this->setDescription('Clear categories');
        $this->addArgument('removeImage', InputArgument::OPTIONAL, 'Remove image');
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
        $removeImage = $input->getArgument('removeImage') !== null;

        $this->categorySynchronizer->clear($removeImage);

        return 0;
    }
}
