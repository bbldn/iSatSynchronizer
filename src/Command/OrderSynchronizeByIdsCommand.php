<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\OrderSynchronizer as OrderBackToFrontSynchronizer;
use App\Service\Synchronizer\FrontToBack\OrderSynchronizer as OrderFrontToBackSynchronizer;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'order:synchronize:by-ids';

    /** @var OrderFrontToBackSynchronizer $orderFrontToBackSynchronizer */
    protected $orderFrontToBackSynchronizer;

    /** @var OrderBackToFrontSynchronizer $orderBackToFrontSynchronizer */
    protected $orderBackToFrontSynchronizer;

    /**
     * OrderSynchronizeByIdsCommand constructor.
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
        $this->setDescription('Order one synchronize');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Reset image');
    }

    protected function load(): void
    {
        $this->orderFrontToBackSynchronizer->load();
        $this->orderBackToFrontSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $ids = $this->testIds($input);
            $this->orderFrontToBackSynchronizer->synchronizeByIds($ids);
        } elseif ('backToFront' === $direction) {
            $ids = $this->testIds($input);
            $this->orderBackToFrontSynchronizer->synchronizeByIds($ids);
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}