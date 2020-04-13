<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CurrencySynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'currency:synchronize:all';
    private $currencySynchronizer;

    public function __construct(CurrencySynchronizer $currencySynchronizer)
    {
        $this->currencySynchronizer = $currencySynchronizer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Currency all');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->currencySynchronizer->synchronize();

        return 0;
    }
}