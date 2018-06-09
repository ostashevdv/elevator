<?php
/**
 * Created by ostashev@shogo.ru (09.06.2018 15:02)
 */

namespace App\Controller;


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
        return $this->getMockResponse(__METHOD__);
    }

    /**
     * @Route("/orders")
     */
    public function orders(): Response
    {
        return $this->getMockResponse(__METHOD__);
    }

    /**
     * @Route("/order/{from}/{to}")
     */
    public function order($from, $to): Response
    {
        return $this->getMockResponse(__METHOD__, func_get_args() ?? null);
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