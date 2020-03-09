<?php

namespace App\Command;

use App\Service\CategorySynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SynchronizeCategoriesCommand extends Command
{
    protected static $defaultName = 'synchronize:categories';
    private $categorySynchronize;

    public function __construct(CategorySynchronize $categorySynchronize)
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
        $this->categorySynchronize->synchronize();
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
