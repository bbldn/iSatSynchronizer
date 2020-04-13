<?php

namespace App\Other;

use Symfony\Component\Console\Input\InputInterface;

trait OneSynchronizeCommandTrait
{
    protected function parseId(InputInterface $input): int
    {
        return (int)$this->testId($input);
    }

    protected function parseIdArray(InputInterface $input): array
    {
        return explode(',', $this->testIds($input));
    }

    protected function testId(InputInterface $input): string
    {
        $id = $input->getArgument('id');
        if (0 === preg_match('/[0-9]+/', $id)) {
            throw new \InvalidArgumentException("`id` must be int: {$id}");
        }

        return $id;
    }

    protected function testIds(InputInterface $input): string
    {
        $ids = trim(rtrim($input->getArgument('ids'), ','));
        if (0 === preg_match('/^([0-9]+,?)+$/i', $ids)) {
            throw new \InvalidArgumentException('parameter `id` has error');
        }

        return $ids;
    }
}