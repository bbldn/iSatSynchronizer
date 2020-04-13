<?php

namespace App\Command;

use App\Exception\OrderBackNotFoundException;
use App\Exception\OrderFrontNotFoundException;
use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\OrderSynchronizer as OrderBackToFrontSynchronizer;
use App\Service\Synchronizer\FrontToBack\OrderSynchronizer as OrderFrontToBackSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderSynchronizeOneCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'order:synchronize:one';
    private $orderFrontToBackSynchronizer;
    private $orderBackToFrontSynchronizer;

    public function __construct(
        OrderFrontToBackSynchronizer $orderFrontToBackSynchronizer,
        OrderBackToFrontSynchronizer $orderBackToFrontSynchronizer
    )
    {
        $this->orderFrontToBackSynchronizer = $orderFrontToBackSynchronizer;
        $this->orderBackToFrontSynchronizer = $orderBackToFrontSynchronizer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Order one synchronize');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
        $this->addArgument('id', InputArgument::REQUIRED, 'Reset image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $id = $this->parseId($input);
            try {
                $this->orderFrontToBackSynchronizer->synchronizeOne($id);
            } catch (OrderFrontNotFoundException $e) {
                throw new \InvalidArgumentException("Order Front with `id`: {$id} not found");
            }
        } elseif ('backToFront' === $direction) {
            $id = $this->parseId($input);
            try {
                $this->orderBackToFrontSynchronizer->synchronizeOne($id);
            } catch (OrderBackNotFoundException $e) {
                throw new \InvalidArgumentException("Order Back with `id`: {$id} not found");
            }
        } else {
            throw new \InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}