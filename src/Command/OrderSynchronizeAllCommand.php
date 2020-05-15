<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\OrderSynchronizer as OrderBackToFrontSynchronizer;
use App\Service\Synchronizer\FrontToBack\OrderSynchronizer as OrderFrontToBackSynchronizer;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'order:synchronize:all';

    /** @var OrderFrontToBackSynchronizer $orderFrontToBackSynchronizer */
    protected $orderFrontToBackSynchronizer;

    /** @var OrderBackToFrontSynchronizer $orderBackToFrontSynchronizer */
    protected $orderBackToFrontSynchronizer;

    /**
     * OrderSynchronizeAllCommand constructor.
     * @param OrderFrontToBackSynchronizer $orderFrontToBackSynchronizer
     * @param OrderBackToFrontSynchronizer $orderBackToFrontSynchronizer
     */
    public function __construct(
        OrderFrontToBackSynchronizer $orderFrontToBackSynchronizer,
        OrderBackToFrontSynchronizer $orderBackToFrontSynchronizer
    )
    {
        $this->orderFrontToBackSynchronizer = $orderFrontToBackSynchronizer;
        $this->orderBackToFrontSynchronizer = $orderBackToFrontSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize orders');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $this->orderFrontToBackSynchronizer->synchronizeAll();
        } elseif ('backToFront' === $direction) {
            $this->orderBackToFrontSynchronizer->synchronizeAll();
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}