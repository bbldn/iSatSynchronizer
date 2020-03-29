<?php

namespace App\Command;

use App\Exception\CategoryBackNotFoundException;
use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryOneSynchronizeCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'category:one:synchronize';
    private $categorySynchronize;

    public function __construct(CategorySynchronizer $categorySynchronize)
    {
        $this->categorySynchronize = $categorySynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Category one synchronize');
        $this->addArgument('id', InputArgument::REQUIRED, 'Category id');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $this->parseId($input);
        $loadImage = $input->getArgument('loadImage') !== null;

        try {
            $this->categorySynchronize->synchronizeOne($id, $loadImage);
        } catch (CategoryBackNotFoundException $notFoundException) {
            throw new \InvalidArgumentException("Category Front with `id`: {$id} not found");
        }

        return 0;
    }
}