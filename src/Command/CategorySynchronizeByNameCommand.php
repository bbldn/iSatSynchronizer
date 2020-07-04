<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorySynchronizeByNameCommand extends Command
{
    protected static $defaultName = 'category:synchronize:by-name';

    /** @var CategorySynchronizer $categorySynchronize */
    protected $categorySynchronize;

    /**
     * CategorySynchronizeByIdsCommand constructor.
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
        $this->setDescription('Category one synchronize');
        $this->addArgument('name', InputArgument::REQUIRED, 'Category name');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
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
        $this->categorySynchronize->load()->synchronizeByName($name, $loadImage);

        return 0;
    }

}