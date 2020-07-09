<?php

namespace App\Event\BackToFront;

use Symfony\Contracts\EventDispatcher\Event;

class ProductsClearEvent extends Event
{
    /** @var bool $clearImage */
    protected $clearImage;

    /**
     * ProductsClearEvent constructor.
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
     * @return ProductsClearEvent
     */
    public function setClearImage(bool $clearImage): self
    {
        $this->clearImage = $clearImage;

        return $this;
    }
}