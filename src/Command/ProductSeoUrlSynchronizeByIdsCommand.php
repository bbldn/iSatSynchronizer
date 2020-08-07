<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.07.20
 * Time: 15:19
 */

namespace App\Command;


use App\Contract\BackToFront\ProductSeoUrlSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSeoUrlSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'product:seo-url:synchronize:by-ids';

    /** @var ProductSeoUrlSynchronizerInterface $productSeoUrlSynchronizer */
    protected $productSeoUrlSynchronizer;

    /**
     * ProductSeoUrlSynchronizeAllCommand constructor.
     * @param ProductSeoUrlSynchronizerInterface $productSeoUrlSynchronizer
     */
    public function __construct(ProductSeoUrlSynchronizerInterface $productSeoUrlSynchronizer)
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
        $this->addArgument('ids', InputArgument::REQUIRED, 'Ids');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
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
        $ids = $this->getIdsFromInput($input);
        $this->productSeoUrlSynchronizer->synchronizeByIds($ids);

        return Command::SUCCESS;
    }
}