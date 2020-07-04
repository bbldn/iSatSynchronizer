<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\AttributeSynchronizer;
use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllClearCommand extends Command
{
    protected static $defaultName = 'all:clear';

    /** @var AttributeSynchronizer $attributeSynchronize */
    protected $attributeSynchronize;

    /** @var CategorySynchronizer $categorySynchronize */
    protected $categorySynchronize;

    /** @var ProductSynchronizer $productSynchronize */
    protected $productSynchronize;

    /**
     * AllClearCommand constructor.
     * @param AttributeSynchronizer $attributeSynchronize
     * @param CategorySynchronizer $categorySynchronize
     * @param ProductSynchronizer $productSynchronize
     */
    public function __construct(
        AttributeSynchronizer $attributeSynchronize,
        CategorySynchronizer $categorySynchronize,
        ProductSynchronizer $productSynchronize
    )
    {
        $this->attributeSynchronize = $attributeSynchronize;
        $this->categorySynchronize = $categorySynchronize;
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Clear all');
        $this->addArgument('resetImage', InputArgument::OPTIONAL, 'Reset image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $resetImage = $input->getArgument('resetImage') !== null;
        $this->productSynchronize->load()->clear($resetImage);
        $this->attributeSynchronize->load()->clear();
        $this->categorySynchronize->load()->clear($resetImage);

        return 0;
    }
}