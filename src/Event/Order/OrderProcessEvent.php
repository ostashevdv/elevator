<?php
/**
 * Created by ostashev@shogo.ru (13.06.2018 20:00)
 */

namespace App\Event\Order;


use App\Entity\Order;
use Symfony\Component\EventDispatcher\Event;

class OrderProcessEvent extends Event
{
    private $order;

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