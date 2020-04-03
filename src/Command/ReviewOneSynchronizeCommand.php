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

class ReviewOneSynchronizeCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'review:one:synchronize';

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
        $this->addArgument('id', InputArgument::REQUIRED, 'idReview');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $id = $this->parseId($input);
            try {
                $this->reviewFrontToBackSynchronizer->synchronizeOne($id);
            } catch (ReviewFrontNotFoundException $e) {
                throw new \InvalidArgumentException("Review Front with `id`: {$id} not found");
            }
        } elseif ('backToFront' === $direction) {
            $id = $this->parseId($input);
            try {
                $this->reviewBackToFrontSynchronizer->synchronizeOne($id);
            } catch (ReviewBackNotFoundException $e) {
                throw new \InvalidArgumentException("Review Back with `id`: {$id} not found");
            }
        } else {
            throw new \InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}