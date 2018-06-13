<?php
/**
 * Created by ostashev@shogo.ru (13.06.2018 17:30)
 */

namespace App\Service;


use App\Entity\Order;
use App\Repository\ElevatorLogRepository;
use App\Repository\ElevatorRepository;
use App\Repository\OrderRepository;
use Doctrine\Common\Persistence\ObjectManager;

class ElevatorManager
{
    private $em;

    private $elevatorRepository;

    private $orderRepository;

    private $elevatorLogRepository;

    public function __construct(
        ObjectManager $em,
        ElevatorRepository $elevatorRepository,
        OrderRepository $orderRepository,
        ElevatorLogRepository $elevatorLogRepository
    ) {
        $this->em = $em;
        $this->elevatorRepository = $elevatorRepository;
        $this->orderRepository = $orderRepository;
        $this->elevatorLogRepository = $elevatorLogRepository;
    }

    public function applyOrder(Order $order): void
    {
        $elevator = $this->elevatorRepository->findNearlyElevator($order->getFromFloor());
        $order->setElevator($elevator);
        $this->em->persist($order);
        $this->em->flush();
    }

    public function processOrders(): void
    {
        $orders = $this->orderRepository->findAwaitOrders();
        foreach ($orders as $order) {
            $order->process();
            $this->em->persist($order);
            $this->em->flush();

        }

        //TODO: опустить лифт на первый этаж;
    }
}