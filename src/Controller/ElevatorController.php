<?php
/**
 * Created by ostashev@shogo.ru (09.06.2018 15:02)
 */

namespace App\Controller;


use App\Entity\Elevator;
use App\Entity\Order;
use App\Event\AppEvents;
use App\Event\Order\OrderCreatedEvent;
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
        return $this->render('elevator/index.html.twig', [
            'elevators' => $elevators
        ]);
    }

    /**
     * @Route("/orders")
     */
    public function orders(): Response
    {
        $orders = $this->getDoctrine()->getRepository(Order::class)->findAll();
        return $this->render('elevator/orders.html.twig', [
            'orders' => $orders,
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
     * @Route("/log")
     */
    public function log(): Response
    {
        return $this->getMockResponse(__METHOD__);
    }

    private function getMockResponse(string $action, ?array $params = []): Response
    {
        if ($params) {
            dump($params);
        }

        return new Response("<html><body>{$action}</body></html>");
    }
}