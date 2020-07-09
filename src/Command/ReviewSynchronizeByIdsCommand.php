<?php

namespace App\Command;

use App\Contract\BackToFront\ReviewSynchronizerContract;
use App\Service\Synchronizer\BackToFront\ReviewSynchronizer as ReviewBackToFrontSynchronizer;
use App\Service\Synchronizer\FrontToBack\ReviewSynchronizer as ReviewFrontToBackSynchronizer;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReviewSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'review:synchronize:by-ids';

    /** @var ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer */
    protected $reviewFrontToBackSynchronizer;

    /** @var ReviewSynchronizerContract $reviewBackToFrontSynchronizer */
    protected $reviewBackToFrontSynchronizer;

    /**
     * ReviewSynchronizeByIdsCommand constructor.
     * @param ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer
     * @param ReviewSynchronizerContract $reviewBackToFrontSynchronizer
     */
    public function __construct(
        ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer,
        ReviewSynchronizerContract $reviewBackToFrontSynchronizer
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
            $ids = $this->testIds($input);
            $this->reviewFrontToBackSynchronizer->synchronizeByIds($ids);
        } elseif ('backToFront' === $direction) {
            $ids = $this->testIds($input);
            $this->reviewBackToFrontSynchronizer->synchronizeByIds($ids);
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}