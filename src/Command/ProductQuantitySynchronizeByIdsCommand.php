<?php

namespace App\Command;

use App\Entity\Back\Product;
use App\Helper\BackToFront\ProductQuantityHelper;
use App\Helper\ExceptionFormatter;
use App\Repository\ProductRepository;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class ProductQuantitySynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'product:quantity:synchronize:by-ids';

    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductQuantityHelper $productQuantityHelper */
    protected $productQuantityHelper;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /**
     * ProductQuantitySynchronizeAllCommand constructor.
     * @param LoggerInterface $logger
     * @param ProductQuantityHelper $productQuantityHelper
     * @param ProductRepository $productRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ProductQuantityHelper $productQuantityHelper,
        ProductRepository $productRepository)
    {
        $this->logger = $logger;
        $this->productQuantityHelper = $productQuantityHelper;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize reviews');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction (front|back)');
        $this->addArgument('ids', InputArgument::REQUIRED, 'ids');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');
        if ('front' === $direction) {
            $ids = $this->getIdsFromInput($input);
            $this->action($this->productRepository->findByFrontIds($ids));
        } elseif ('back' === $direction) {
            $ids = $this->getIdsFromInput($input);
            $this->action($this->productRepository->findByBackIds($ids));
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }

    /**
     * @param Product[] $products
     */
    protected function action(array $products): void
    {
        foreach ($products as $product) {
            try {
                $this->productQuantityHelper->action($product);
            } catch (Throwable $e) {
                $this->logger->error(ExceptionFormatter::e($e));
            }
        }
    }
}