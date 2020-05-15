<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryClearCommand extends Command
{
    protected static $defaultName = 'category:clear';

    /** @var CategorySynchronizer $categorySynchronize */
    protected $categorySynchronize;

    /**
     * CategoryClearCommand constructor.
     * @param CategorySynchronizer $categorySynchronize
     */
    public function __construct(CategorySynchronizer $categorySynchronize)
    {
        $this->categorySynchronize = $categorySynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Clear categories');
        $this->addArgument('removeImage', InputArgument::OPTIONAL, 'Remove image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $removeImage = $input->getArgument('removeImage') !== null;
        $this->categorySynchronize->clear($removeImage);

        return 0;
    }
}
