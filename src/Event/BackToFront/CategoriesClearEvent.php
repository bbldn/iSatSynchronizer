<?php

namespace App\Event\BackToFront;

use Symfony\Contracts\EventDispatcher\Event;

class CategoriesClearEvent extends Event
{
    /** @var bool $clearImage */
    protected $clearImage;

    /**
     * CategoriesClearEvent constructor.
     * @param bool $clearImage
     */
    public function __construct(bool $clearImage)
    {
        $this->clearImage = $clearImage;
    }

    /**
     * @return bool
     */
    public function isClearImage(): bool
    {
        return $this->clearImage;
    }

    /**
     * @param bool $clearImage
     * @return CategoriesClearEvent
     */
    public function setClearImage(bool $clearImage): self
    {
        $this->clearImage = $clearImage;

        return $this;
    }
}