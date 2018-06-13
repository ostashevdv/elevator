<?php
/**
 * Created by ostashev@shogo.ru (13.06.2018 12:31)
 */

namespace App\EventSubscriber;


use App\Event\AppEvents;
use App\Event\Order\OrderCompletedEvent;
use App\Event\Order\OrderCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AppSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            AppEvents::EVENT_ORDER_CREATED => [
                ['onOrderCreated', 10],
                ['onOrderProcess', 0],
            ],

            AppEvents::EVENT_ORDER_COMPLETED => [
                ['onOrderCompleted'],
            ],
        ];
    }

    public function onOrderCreated(OrderCreatedEvent $event): void
    {

    }

    public function onOrderProcess(): void
    {

    }

    public function onOrderCompleted(OrderCompletedEvent $event): void
    {

    }
}