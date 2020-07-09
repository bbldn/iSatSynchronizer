<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.07.20
 * Time: 15:19
 */

namespace App\Command;


use App\Service\Synchronizer\BackToFront\ProductSeoUrlSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductSeoUrlSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'product:seo-url:synchronize:by-ids';

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
        $this->addArgument('ids', InputArgument::REQUIRED, 'Ids');
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
        $ids = $this->testIds($input);
        $this->productSeoUrlSynchronizer->synchronizeByIds($ids);

        return 0;
    }
}