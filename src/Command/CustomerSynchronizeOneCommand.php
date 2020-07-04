<?php

namespace App\Command;

use App\Exception\CustomerFrontNotFoundException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\Synchronizer\FrontToBack\CustomerSynchronizer as CustomerFrontToBackSynchronize;

class CustomerSynchronizeOneCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:one';

    /** @var CustomerFrontToBackSynchronize $customerFrontToBackSynchronize */
    protected $customerFrontToBackSynchronize;

    /**
     * CustomerSynchronizeOneCommand constructor.
     * @param CustomerFrontToBackSynchronize $customerFrontToBackSynchronize
     */
    public function __construct(CustomerFrontToBackSynchronize $customerFrontToBackSynchronize)
    {
        $this->customerFrontToBackSynchronize = $customerFrontToBackSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize customers');
        $this->addArgument('id', InputArgument::REQUIRED, 'idCustomer');
        $this->addArgument('password', InputArgument::REQUIRED, 'passwordCustomer');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws CustomerFrontNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $this->parseId($input);
        $password = $input->getArgument('password');
        $this->customerFrontToBackSynchronize->load()->synchronizeOne((int)$id, $password);

        return 0;
    }
}