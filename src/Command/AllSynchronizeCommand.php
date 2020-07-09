<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\AttributeSynchronizer;
use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllSynchronizeCommand extends Command
{
    protected static $defaultName = 'all:synchronize';

    /** @var AttributeSynchronizer $attributeSynchronize */
    protected $attributeSynchronize;

    /** @var CategorySynchronizer $categorySynchronize */
    protected $categorySynchronize;

    /** @var ProductSynchronizer $productSynchronize */
    protected $productSynchronize;

    /**
     * AllSynchronizeCommand constructor.
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
        $this->setDescription('Synchronize all');
        $this->addArgument('resetImage', InputArgument::OPTIONAL, 'Reset image');
    }

    /**
     *
     */
    protected function load(): void
    {
        $this->categorySynchronize->load();
        $this->attributeSynchronize->load();
        $this->productSynchronize->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $resetImage = $input->getArgument('resetImage') !== null;

        $this->categorySynchronize->synchronizeAll($resetImage);
        $this->attributeSynchronize->synchronizeAll();
        $this->productSynchronize->synchronizeAll($resetImage);

        return 0;
    }
}