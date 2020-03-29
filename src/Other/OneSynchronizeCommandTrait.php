<?php

namespace App\Other;

use Symfony\Component\Console\Input\InputInterface;

trait OneSynchronizeCommandTrait
{
    protected function parseId(InputInterface $input): int
    {
        $id = $input->getArgument('id');
        if (0 === preg_match('/[0-9]+/', $id)) {
            throw new \InvalidArgumentException("`id` must be int: {$id}");
        }

        return (int)$id;
    }
}