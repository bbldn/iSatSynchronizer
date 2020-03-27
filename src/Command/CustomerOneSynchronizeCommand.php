<?php

namespace App\Command;

use App\Exception\CustomerBackNotFoundException;
use App\Service\Synchronizer\BackToFront\CustomerSynchronize as CustomerBackToFrontSynchronize;
use App\Service\Synchronizer\FrontToBack\CustomerSynchronize as CustomerFrontToBackSynchronize;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerOneSynchronizeCommand extends OneSynchronizeCommand
{
    protected static $defaultName = 'customer:one:synchronize';
    private $customerBackToFrontSynchronize;
    private $customerFrontToBackSynchronize;

    public function __construct(CustomerBackToFrontSynchronize $customerBackToFrontSynchronize,
                                CustomerFrontToBackSynchronize $customerFrontToBackSynchronize)
    {
        $this->customerBackToFrontSynchronize = $customerBackToFrontSynchronize;
        $this->customerFrontToBackSynchronize = $customerFrontToBackSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize customers');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
        $this->addArgument('id', InputArgument::REQUIRED, 'idCustomer');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $this->customerFrontToBackSynchronize;
        } elseif ('backToFront' === $direction) {
            $id = $this->parseId($input);
            try {
                $this->customerBackToFrontSynchronize->synchronizeOne($id);
            } catch (CustomerBackNotFoundException $e) {
                throw new \InvalidArgumentException("Customer Front with `id`: {$id} not found");
            }
        } else {
            throw new \InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}