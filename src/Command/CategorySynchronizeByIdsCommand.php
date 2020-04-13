<?php

namespace App\Command;

use App\Exception\CategoryBackNotFoundException;
use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorySynchronizeByIdsCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'category:synchronize:by-ids';
    private $categorySynchronize;

    public function __construct(CategorySynchronizer $categorySynchronize)
    {
        $this->categorySynchronize = $categorySynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Category one synchronize');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Category ids');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->testIds($input);
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->categorySynchronize->synchronizeByIds($ids, $loadImage);

        return 0;
    }
}