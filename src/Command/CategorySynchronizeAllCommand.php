<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'category:synchronize:all';
    private $categorySynchronize;

    public function __construct(CategorySynchronizer $categorySynchronize)
    {
        $this->categorySynchronize = $categorySynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize categories');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Load image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->categorySynchronize->synchronizeAll($loadImage);
//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
