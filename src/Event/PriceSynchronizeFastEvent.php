<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class PriceSynchronizeFastEvent extends Event
{
    /** @var string $ids */
    protected $ids;

    /**
     * PriceSynchronizeFastEvent constructor.
     * @param string $ids
     */
    public function __construct(string $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return string
     */
    public function getIds(): string
    {
        return $this->ids;
    }

    /**
     * @param string $ids
     * @return PriceSynchronizeFastEvent
     */
    public function setIds(string $ids): self
    {
        $this->ids = $ids;

        return $this;
    }
}