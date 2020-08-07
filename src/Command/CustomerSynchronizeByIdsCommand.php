<?php

namespace App\Command;

use App\Contract\BackToFront\CustomerSynchronizerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:by-ids';

    /** @var CustomerSynchronizerInterface $customerSynchronizer */
    protected $customerSynchronizer;

    /**
     * CustomerSynchronizeByIdsCommand constructor.
     * @param CustomerSynchronizerInterface $customerSynchronizer
     */
    public function __construct(CustomerSynchronizerInterface $customerSynchronizer)
    {
        $this->customerSynchronizer = $customerSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize customers');
        $this->addArgument('ids', InputArgument::REQUIRED, 'idCustomer');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->customerSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->getIdsFromInput($input);
        $this->customerSynchronizer->synchronizeByIds($ids);

        return Command::SUCCESS;
    }
}