<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CustomerSynchronizer as CustomerBackToFrontSynchronize;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:all';

    /** @var CustomerBackToFrontSynchronize $customerBackToFrontSynchronize */
    protected $customerBackToFrontSynchronize;

    /**
     * CustomerSynchronizeAllCommand constructor.
     * @param CustomerBackToFrontSynchronize $customerBackToFrontSynchronize
     */
    public function __construct(CustomerBackToFrontSynchronize $customerBackToFrontSynchronize)
    {
        $this->customerBackToFrontSynchronize = $customerBackToFrontSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize customers');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->customerBackToFrontSynchronize->synchronizeAll();

        return 0;
    }
}