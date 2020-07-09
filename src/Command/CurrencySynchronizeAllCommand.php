<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CurrencySynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'currency:synchronize:all';

    /** @var CurrencySynchronizer $currencySynchronizer */
    protected $currencySynchronizer;

    /**
     * CurrencySynchronizeAllCommand constructor.
     * @param CurrencySynchronizer $currencySynchronizer
     */
    public function __construct(CurrencySynchronizer $currencySynchronizer)
    {
        $this->currencySynchronizer = $currencySynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Currency all');
    }

    /**
     *
     */
    protected function load(): void
    {
        $this->currencySynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $this->currencySynchronizer->synchronizeAll();

        return 0;
    }
}