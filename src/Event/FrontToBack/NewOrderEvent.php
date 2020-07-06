<?php

namespace App\Event\FrontToBack;

use Symfony\Contracts\EventDispatcher\Event;

class NewOrderEvent extends Event
{
    /** @var int $orderId */
    protected $orderId;

    /**
     * NewOrderEvent constructor.
     * @param int $orderId
     */
    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return NewOrderEvent
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }
}