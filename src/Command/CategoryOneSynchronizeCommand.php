<?php

namespace App\Command;

use App\Exception\CategoryBackNotFoundException;
use App\Service\Synchronizer\BackToFront\CategorySynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryOneSynchronizeCommand extends Command
{
    protected static $defaultName = 'category:one:synchronize';
    private $categorySynchronize;

    public function __construct(CategorySynchronize $categorySynchronize)
    {
        $this->categorySynchronize = $categorySynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Category one synchronize');
        $this->addArgument('idCategory', InputArgument::REQUIRED, 'Category id');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getArgument('idCategory') === null) {
            $output->writeln("Parameter `id` not found");
        }

        $id = $input->getArgument('idCategory');
        if (0 === preg_match('/[0-9]+/', $id)) {
            $output->writeln("`id` must be int: {$id}");

            return -1;
        }

        $loadImage = $input->getArgument('loadImage') !== null;
        try {
            $this->categorySynchronize->synchronizeOne((int)$id, $loadImage);
        } catch (CategoryBackNotFoundException $notFoundException) {
            $output->writeln("Category Front with `id`: {$id} not found");

            return -1;
        }

        return 0;
    }
}