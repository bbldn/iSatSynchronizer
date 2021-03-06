<?php

namespace App\Command;

use InvalidArgumentException;
use Symfony\Component\Console\Command\Command as Base;
use Symfony\Component\Console\Input\InputInterface;

abstract class Command extends Base
{
    /**
     * @param InputInterface $input
     * @return array
     */
    protected function parseIdArray(InputInterface $input): array
    {
        return explode(',', $this->getIdsFromInput($input));
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    protected function getIdsFromInput(InputInterface $input): string
    {
        $ids = rtrim(trim($input->getArgument('ids')), ',');
        if (0 === preg_match('/^([0-9]+,?)+$/i', $ids)) {
            throw new InvalidArgumentException('parameter `id` has error');
        }

        return $ids;
    }

    /**
     * @param InputInterface $input
     * @return int
     */
    protected function getIdFromInput(InputInterface $input): int
    {
        $id = trim($input->getArgument('id'));
        if (0 === preg_match('/[0-9]+/', $id)) {
            throw new InvalidArgumentException("`id` must be int: {$id}");
        }

        return (int)$id;
    }
}