<?php

namespace App\Event\FrontToBack;

use App\Entity\Order;
use Symfony\Contracts\EventDispatcher\Event;

class NewOrderEvent extends Event
{
    /** @var Order $order */
    protected $order;

    /**
     * NewOrderEvent constructor.
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
     * @return NewOrderEvent
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}