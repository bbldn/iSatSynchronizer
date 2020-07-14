<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanSynchronizeAll;

interface CategorySynchronizerContract extends CanLoadInterface, CanSynchronizeAll
{
    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll(bool $synchronizeImage = false): void;

    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void;

    /**
     * @param string $name
     * @param bool $synchronizeImage
     */
    public function synchronizeByName(string $name, bool $synchronizeImage = false): void;


    /**
     * @param bool $synchronizeImage
     */
    public function reload(bool $synchronizeImage = false): void;

    /**
     * @param bool $clearImage
     */
    public function clear(bool $clearImage = false): void;
}