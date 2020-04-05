<?php

namespace App\Command;

use App\Exception\CategoryBackNotFoundException;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Other\OneSynchronizeCommandTrait;
use Symfony\Component\Console\Command\Command;
use App\Service\Synchronizer\BackToFront\ProductURLSynchronizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductURLOneSynchronizeCommand extends Command
{
    use OneSynchronizeCommandTrait;

    protected static $defaultName = 'product-url:one:synchronize';

    private $productURLSynchronizer;

    public function __construct(ProductURLSynchronizer $productURLSynchronizer)
    {
        $this->productURLSynchronizer = $productURLSynchronizer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize product urls');
        $this->addArgument('id', InputArgument::REQUIRED, 'Product id');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $this->parseId($input);

        try {
            $this->productURLSynchronizer->synchronizeOne($id);
        } catch (ProductNotFoundException $productNotFoundException) {
            throw new \InvalidArgumentException("Product not found");
        } catch (ProductBackNotFoundException $productBackNotFoundException) {
            throw new \InvalidArgumentException("Product Back not found");
        } catch (CategoryBackNotFoundException $categoryBackNotFoundException) {
            throw new \InvalidArgumentException("Category Back not found");
        }

        return 0;
    }
}