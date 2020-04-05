<?php

namespace App\Command;

use App\Exception\CategoryBackNotFoundException;
use App\Exception\ProductBackNotFoundException;
use App\Service\Synchronizer\BackToFront\ProductURLSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductURLSynchronizeCommand extends Command
{
    protected static $defaultName = 'product-url:synchronize';

    private $productURLSynchronizer;

    public function __construct(ProductURLSynchronizer $productURLSynchronizer)
    {
        $this->productURLSynchronizer = $productURLSynchronizer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize products urls');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->productURLSynchronizer->synchronizeAll();
        } catch (ProductBackNotFoundException $productBackNotFoundException) {
            throw new \InvalidArgumentException("Product Back not found");
        } catch (CategoryBackNotFoundException $categoryBackNotFoundException) {
            throw new \InvalidArgumentException("Category Back not found");
        }

        return 0;
    }
}