<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\DescriptionSynchronizer as DescriptionBaseSynchronizer;

class DescriptionSynchronizer extends DescriptionBaseSynchronizer
{
    /**
     * @param string|null $text
     * @return string
     */
    public function synchronize(?string $text): string
    {
        return parent::synchronize($text);
    }

    /**
     *
     */
    public function clearFolder(): void
    {
        parent::clearFolder();
    }
}