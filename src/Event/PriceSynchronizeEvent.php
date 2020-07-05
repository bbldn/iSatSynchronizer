<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class PriceSynchronizeEvent extends Event
{
    /** @var array $data */
    protected $data;

    /**
     * SynchronizePriceByIdsEvent constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return PriceSynchronizeEvent
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}