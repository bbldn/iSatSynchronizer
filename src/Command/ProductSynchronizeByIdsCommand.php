<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'product:synchronize:by-ids';

    /** @var ProductSynchronizer $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductSynchronizeByIdsCommand constructor.
     * @param ProductSynchronizer $productSynchronize
     */
    public function __construct(ProductSynchronizer $productSynchronize)
    {
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Product one Synchronize');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Product `id`');
        $this->addArgument('loadImage', InputArgument::OPTIONAL, 'Synchronize image');
    }

    /**
     *
     */
    protected function load(): void
    {
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
        $ids = $this->testIds($input);
        $loadImage = $input->getArgument('loadImage') !== null;
        $this->productSynchronize->synchronizeByIds($ids, $loadImage);

        return 0;
    }
}