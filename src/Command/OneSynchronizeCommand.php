<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class OneSynchronizeCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function parseId(InputInterface $input): int
    {
        $id = $input->getArgument('id');
        if (0 === preg_match('/[0-9]+/', $id)) {
            throw new \InvalidArgumentException("`id` must be int: {$id}");
        }

        return (int)$id;
    }
}