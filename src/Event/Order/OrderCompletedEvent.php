<?php
/**
 * Created by ostashev@shogo.ru (13.06.2018 12:41)
 */

namespace App\Event\Order;


use App\Entity\Order;
use Symfony\Component\EventDispatcher\Event;

class OrderCompletedEvent extends Event
{
    private $order;

    /**
     * OrderCompletedEvent constructor.
     * @param $order
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
}