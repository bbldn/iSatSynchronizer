<?php

namespace App\Command;

use InvalidArgumentException;
use Symfony\Component\Console\Command\Command as Base;
use Symfony\Component\Console\Input\InputInterface;

abstract class Command extends Base
{
    /**
     * @param InputInterface $input
     * @return int
     */
    protected function parseId(InputInterface $input): int
    {
        return (int)$this->testId($input);
    }

    /**
     * @param InputInterface $input
     * @return array
     */
    protected function parseIdArray(InputInterface $input): array
    {
        return explode(',', $this->testIds($input));
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    protected function testId(InputInterface $input): string
    {
        $id = $input->getArgument('id');
        if (0 === preg_match('/[0-9]+/', $id)) {
            throw new InvalidArgumentException("`id` must be int: {$id}");
        }

        return $id;
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    protected function testIds(InputInterface $input): string
    {
        $ids = trim(rtrim($input->getArgument('ids'), ','));
        if (0 === preg_match('/^([0-9]+,?)+$/i', $ids)) {
            throw new InvalidArgumentException('parameter `id` has error');
        }

        return $ids;
    }
}