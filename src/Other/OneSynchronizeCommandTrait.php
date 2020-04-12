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

    protected function parseIdArray(InputInterface $input): array
    {
        $ids = trim(rtrim($input->getArgument('ids'), ','));
        if (0 === preg_match('/^([0-9]+,?)+$/i', $ids)) {
            throw new \InvalidArgumentException('parameter `id` has error');
        }

        return explode(',', $ids);
    }
}