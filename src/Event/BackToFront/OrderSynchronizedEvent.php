<?php

namespace App\Event\BackToFront;

use App\Entity\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderSynchronizedEvent extends Event
{
    /** @var Order $order */
    protected $order;

    /**
     * OrderSynchronizeEvent constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return OrderSynchronizedEvent
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}