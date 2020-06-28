<?php

namespace App\Command;

use App\Service\Synchronizer\Novaposhta\WarehousesSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NovaposhtaWarehouseSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'novaposhta:warehouse:synchronize:all';

    /** @var WarehousesSynchronizer $warehousesSynchronizer */
    protected $warehousesSynchronizer;

    public function __construct(WarehousesSynchronizer $warehousesSynchronizer)
    {
        parent::__construct();
        $this->warehousesSynchronizer = $warehousesSynchronizer;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warehousesSynchronizer->synchronizeAll();

        return 0;
    }
}