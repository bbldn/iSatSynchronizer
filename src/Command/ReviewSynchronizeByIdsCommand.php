<?php

namespace App\Command;

use App\Exception\ReviewBackNotFoundException;
use App\Exception\ReviewFrontNotFoundException;
use App\Other\OneSynchronizeCommandTrait;
use App\Service\Synchronizer\BackToFront\ReviewSynchronizer as ReviewBackToFrontSynchronizer;
use App\Service\Synchronizer\FrontToBack\ReviewSynchronizer as ReviewFrontToBackSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReviewSynchronizeByIdsCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'review:synchronize:by-ids';

    private $reviewFrontToBackSynchronizer;
    private $reviewBackToFrontSynchronizer;

    public function __construct(
        ReviewFrontToBackSynchronizer $reviewFrontToBackSynchronizer,
        ReviewBackToFrontSynchronizer $reviewBackToFrontSynchronizer
    )
    {
        $this->reviewFrontToBackSynchronizer = $reviewFrontToBackSynchronizer;
        $this->reviewBackToFrontSynchronizer = $reviewBackToFrontSynchronizer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize reviews');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
        $this->addArgument('ids', InputArgument::REQUIRED, 'idReview');
    }

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
            throw new \InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}