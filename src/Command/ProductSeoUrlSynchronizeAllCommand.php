<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ProductSeoUrlSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSeoUrlSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'product:seo-url:synchronize:all';

    /** @var ProductSeoUrlSynchronizer $productSeoUrlSynchronizer */
    protected $productSeoUrlSynchronizer;

    /**
     * ProductSeoUrlSynchronizeAllCommand constructor.
     * @param ProductSeoUrlSynchronizer $productSeoUrlSynchronizer
     */
    public function __construct(ProductSeoUrlSynchronizer $productSeoUrlSynchronizer)
    {
        $this->productSeoUrlSynchronizer = $productSeoUrlSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize products SeoUrl');
    }

    /**
     *
     */
    protected function load(): void
    {
        $this->productSeoUrlSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $this->productSeoUrlSynchronizer->synchronizeAll();

        return 0;
    }
}