<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductClearCommand extends Command
{
    protected static $defaultName = 'product:clear';

    /** @var ProductSynchronizer $productSynchronize */
    protected $productSynchronize;

    /**
     * ProductClearCommand constructor.
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
    protected function configure(): void
    {
        $this->setDescription('Clear products');
        $this->addArgument('removeImage', InputArgument::OPTIONAL, 'remove image');
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
        $removeImage = $input->getArgument('removeImage') !== null;
        $this->productSynchronize->clear($removeImage);

        return 0;
    }
}