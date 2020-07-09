<?php

namespace App\Command;

use App\Service\Synchronizer\Novaposhta\AreaSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NovaposhtaAreaSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'novaposhta:area:synchronize:all';

    /** @var AreaSynchronizer $areaSynchronizer */
    protected $areaSynchronizer;

    /**
     * NovaposhtaAreaSynchronizeAllCommand constructor.
     * @param AreaSynchronizer $areaSynchronizer
     */
    public function __construct(AreaSynchronizer $areaSynchronizer)
    {
        parent::__construct();
        $this->areaSynchronizer = $areaSynchronizer;
    }

    /**
     *
     */
    protected function load(): void
    {
        $this->areaSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $this->areaSynchronizer->synchronizeAll();

        return 0;
    }
}