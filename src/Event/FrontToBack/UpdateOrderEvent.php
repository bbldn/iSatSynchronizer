<?php

namespace App\Event\FrontToBack;

use App\Entity\Order;
use Symfony\Contracts\EventDispatcher\Event;

class UpdateOrderEvent extends Event
{
    /** @var Order $order */
    protected $order;

    /**
     * UpdateOrderEvent constructor.
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
     * @return UpdateOrderEvent
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}