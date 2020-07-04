<?php

namespace App\Command;

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

    /** @var ReviewBackToFrontSynchronizer $reviewBackToFrontSynchronizer */
    protected $reviewBackToFrontSynchronizer;

    /**
     * ReviewSynchronizeByIdsCommand constructor.
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
        $this->addArgument('ids', InputArgument::REQUIRED, 'idReview');
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
            $this->reviewFrontToBackSynchronizer->load()->synchronizeByIds($ids);
        } elseif ('backToFront' === $direction) {
            $ids = $this->testIds($input);
            $this->reviewBackToFrontSynchronizer->load()->synchronizeByIds($ids);
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}