<?php

namespace App\Command;

use App\Service\Synchronizer\Novaposhta\WarehouseSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NovaposhtaWarehouseSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'novaposhta:warehouse:synchronize:all';

    /** @var WarehouseSynchronizer $warehousesSynchronizer */
    protected $warehousesSynchronizer;

    /**
     * NovaposhtaWarehouseSynchronizeAllCommand constructor.
     * @param WarehouseSynchronizer $warehousesSynchronizer
     */
    public function __construct(WarehouseSynchronizer $warehousesSynchronizer)
    {
        parent::__construct();
        $this->warehousesSynchronizer = $warehousesSynchronizer;
    }

    protected function load(): void
    {
        $this->warehousesSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $this->warehousesSynchronizer->synchronizeAll();

        return 0;
    }
}