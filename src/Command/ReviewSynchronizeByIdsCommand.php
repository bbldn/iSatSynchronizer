<?php

namespace App\Command;

use App\Contract\BackToFront\ReviewSynchronizerContract as ReviewBackToFrontSynchronizerContract;
use App\Contract\FrontToBack\ReviewSynchronizerContract as ReviewFrontToBackSynchronizerContract;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReviewSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'review:synchronize:by-ids';

    /** @var ReviewFrontToBackSynchronizerContract $reviewFrontToBackSynchronizer */
    protected $reviewFrontToBackSynchronizer;

    /** @var ReviewBackToFrontSynchronizerContract $reviewBackToFrontSynchronizer */
    protected $reviewBackToFrontSynchronizer;

    /**
     * ReviewSynchronizeByIdsCommand constructor.
     * @param ReviewFrontToBackSynchronizerContract $reviewFrontToBackSynchronizer
     * @param ReviewBackToFrontSynchronizerContract $reviewBackToFrontSynchronizer
     */
    public function __construct(
        ReviewFrontToBackSynchronizerContract $reviewFrontToBackSynchronizer,
        ReviewBackToFrontSynchronizerContract $reviewBackToFrontSynchronizer
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
        $this->addArgument('ids', InputArgument::REQUIRED, 'idReview');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->reviewFrontToBackSynchronizer->load();
        $this->reviewBackToFrontSynchronizer->load();
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
            $ids = $this->getIdsFromInput($input);
            $this->reviewFrontToBackSynchronizer->synchronizeByIds($ids);
        } elseif ('backToFront' === $direction) {
            $ids = $this->getIdsFromInput($input);
            $this->reviewBackToFrontSynchronizer->synchronizeByIds($ids);
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}