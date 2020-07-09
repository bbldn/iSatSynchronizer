<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\AttributeSynchronizer;
use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
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
     *
     */
    protected function load(): void
    {
        $this->productSynchronize->load();
        $this->attributeSynchronize->load();
        $this->categorySynchronize->load();
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

        $this->productSynchronize->clear($resetImage);
        $this->attributeSynchronize->clear();
        $this->categorySynchronize->clear($resetImage);

        return 0;
    }
}