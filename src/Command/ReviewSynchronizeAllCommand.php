<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\ReviewSynchronizer as ReviewBackToFrontSynchronizer;
use App\Service\Synchronizer\FrontToBack\ReviewSynchronizer as ReviewFrontToBackSynchronizer;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReviewSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'review:synchronize:all';

    /** @var ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer */
    protected $reviewFrontToBackSynchronizer;

    /** @var ReviewBackToFrontSynchronizer $reviewBackToFrontSynchronizer */
    protected $reviewBackToFrontSynchronizer;

    /**
     * ReviewSynchronizeAllCommand constructor.
     * @param ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer
     * @param ReviewBackToFrontSynchronizer $reviewBackToFrontSynchronizer
     */
    public function __construct(
        ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer,
        ReviewBackToFrontSynchronizer $reviewBackToFrontSynchronizer
    )
    {
        $this->reviewFrontToBackSynchronizer = $reviewFrontToBackSynchronizer;
        $this->reviewBackToFrontSynchronizer = $reviewBackToFrontSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize reviews');
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
            $this->reviewFrontToBackSynchronizer->synchronizeAll();
        } elseif ('backToFront' === $direction) {
            $this->reviewBackToFrontSynchronizer->synchronizeAll();
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}