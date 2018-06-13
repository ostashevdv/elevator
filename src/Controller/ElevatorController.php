<?php
/**
 * Created by ostashev@shogo.ru (09.06.2018 15:02)
 */

namespace App\Controller;


use App\Entity\Elevator;
use App\Entity\ElevatorLog;
use App\Entity\Order;
use App\Event\AppEvents;
use App\Event\Order\OrderCreatedEvent;
use App\Repository\ElevatorLogRepository;
use App\Service\ElevatorManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElevatorController extends Controller
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        $elevators = $this->getDoctrine()->getRepository(Elevator::class)->findAll();
        $orders = $this->getDoctrine()->getRepository(Order::class)->findBy([], ['createdAt' => 'desc', 'completedAt' => 'desc']);

        /** @var ElevatorLogRepository $logRepository */
        $logRepository = $this->getDoctrine()->getRepository(ElevatorLog::class);

        return $this->render('elevator/index.html.twig', [
            'elevators' => $elevators,
            'orders' => $orders,
            'totalDestination' => $logRepository->totalDestination(),
        ]);
    }

    /**
     * @Route("/order/{from}/{to}")
     */
    public function order($from, $to): Response
    {
        $order = new Order($from, $to);
        $this->getDoctrine()->getManager()->persist($order);
        $this->getDoctrine()->getManager()->flush();

        $this->get('event_dispatcher')->dispatch(AppEvents::EVENT_ORDER_CREATED, new OrderCreatedEvent($order));

        return $this->redirectToRoute('app_elevator_index');
    }

    /**
     * @Route("/process-orders")
     */
    public function processOrders(ElevatorManager $manager)
    {
        $manager->processOrders();
        return $this->redirectToRoute('app_elevator_index');
    }
}